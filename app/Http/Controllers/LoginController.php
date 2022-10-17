<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function auth(Request $request){
      $data = ['email'=>$request->email,'password'=>$request->password];
      if(Auth::attempt($data)){
        if (Auth::user()->role=='customer'&&session()->has('cart')) {
            $cart = null;
            foreach(session('cart')->items as $items){
                $cart = Cart::where('status','Active')->where('post_id',$items['item']->id)->first();
                if ($cart) {
                    $cart->qty += $items['qty'];
                }
               else{
                $cart = new Cart();
                $cart->post_id = $items['item']->id;
                $cart->qty = $items['qty'];
                $cart->status = 'Active';
               }
               Auth::user()->carts()->save($cart);
              $cart = null;
            }
            session()->forget('cart');
        }
        if (count(session('links'))>0) {
            if(session('links')[0]!='cart'&&session('links')[0]!='user/orders'){
                return redirect(session('links')[0]);
            }
           else if(Auth::user()->role==='customer'){
            return redirect(session('links')[0]);
           }
           else{
            return redirect('/');
           }
        }
       else{
        return redirect('/');
       }
      }
     else{
        return back();
     }
    }
    public function create_user(Request $request)
    {
      $validated = $request->validate([
      'email'=>'unique:users,email',
      'phone_no' => 'nullable|min:11|max:11',
      'password' => 'required|confirmed|min:8'
      ]);

    if ($validated) {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            if($request->phone_no){
               $user->phone_no = $request->phone_no;
            }
            $user->role = 'customer';
            $user->save();
            $data = ['email'=>$request->email,'password'=>$request->password];
            if (Auth::attempt($data)) {
             return redirect('/');
            }
        }

    }



public function logout(){
    Auth::logout();
    return redirect('/');
}
}
