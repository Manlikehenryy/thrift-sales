<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
    $this->middleware('user.profile');
   }

    public function orders()
    {
        $orders =  Auth::user()->orders;
        $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
        $total_qty = 0;
        foreach($carts as $cart){
            $total_qty += $cart->qty;
        }

       return view('userOrders',compact('orders','total_qty'));
    }


}
