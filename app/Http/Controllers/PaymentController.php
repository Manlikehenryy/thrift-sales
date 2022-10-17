<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\State;
use App\Models\Address;
use Illuminate\Contracts\Session\Session as SessionSession;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Paystack;
use Session;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function __construct()
    {
     $this->middleware('auth');
     $this->middleware('cardpayment');
    }

   public function index()
   {
    $address = Auth::user()->address;
    if($address){
        $city = City::where('city',$address->city)->first();
        $price = $city->price;

        $total_price = 0;
        $carts =  Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();

        if ($carts) {
            foreach($carts as $cart){
                $total_price += $cart->qty * $cart->post->current_amount;
            }

        }

        $total_price += $price;
        return view('checkout',compact('total_price'));
    }
    else{
        session()->flash('message','Add an address');
        return back();
    }
    // $email = Auth::user()->email;

   }

   public function make_payment(Request $request)
   {
    $address = Auth::user()->address;
    $total_price = 0;
    if($address){
        $city = City::where('city',$address->city)->first();
        $price = $city->price;

        $carts =  Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();

        if ($carts) {
            foreach($carts as $cart){
                $total_price += $cart->qty * $cart->post->current_amount;
            }

        }

        $total_price += $price;
    }

     $formdata = [
        'email' => Auth::user()->email,
        'amount' => $total_price*100,
        'callback_url' => route('pay.callback')
     ];
    $pay = json_decode($this->initiate_payment($formdata));
    if ($pay) {
       if ($pay->status) {
       return redirect($pay->data->authorization_url) ;
       } else {
      return $pay->message;
       }

    } else {
      return 'something went wrong';
    }

   }

   public function initiate_payment($formdata)
   {
    $url = "https://api.paystack.co/transaction/initialize";
    $fields_string = http_build_query($formdata);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer ".env("PAYSTACK_SECRET_KEY"),
        "Cache-Control: no-cache"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
   }

   public function verify_payment($reference)
   {
     $curl = curl_init();
     curl_setopt_array($curl, array(
       CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 30,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "GET",
       CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ". env("PAYSTACK_SECRET_KEY"),
        "Cache-Control: no-cache"
       ),
     ));

     $response = curl_exec($curl);
     curl_close($curl);
     return $response;
   }

   public function callback(Request $request)
   {
    $response = json_decode($this->verify_payment($request->reference));

     $carts =  Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
     $cart_items = [];
     $count = 0;
     foreach($carts as $cart){
       $cart->status = 'Purchased';
      $cart_items[$count] = $cart->post;
      $cart_items[$count]->qty = $cart->qty;
      $cart_items[$count]->price = $cart->post->current_amount*$cart->qty;
      ++$count;
      $cart->save();
     }
    //  onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$drpregtype\',\'\')', 0)"

     $order = new Order();
     $order->posts = serialize($cart_items);
     $order->status = $response->data->status==='success' ? 'Delivery in Progress':'Payment Unsuccessful';
     $order->name = Auth::user()->first_name.''.Auth::user()->last_name;
     $order->user_id = Auth::user()->id;
     $order->address = Auth::user()->address->address;
     $order->payment_id = $response->data->reference;

     $order->city = Auth::user()->address->city;
     $order->state = Auth::user()->address->state;
     $order->phone_no = Auth::user()->address->phoneno;
     $order->recipient = Auth::user()->address->firstname.' '.Auth::user()->address->lastname;
     $order->amount = $response->data->amount/100;

     $order->save();
     return redirect()->route('view.cart.item');
   }

   public function delivery(){
    // $amount = $request->amount;
    // $email = Auth::user()->email;
    //  return view('checkout',compact('amount','email'));
    $carts =  Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
    if (!count($carts)) {
       return back();
    }
    $address = Auth::user()->address;
    $price = null;
    $cities = null;
    $posts = Post::all();
    $categories = Category::all();
    if($address){
        $city = City::where('city',$address->city)->first();
        $price = $city->price;
        $state = State::where('state',$address->state)->first();
        $cities = $state->cities;
    }
    $total_price = 0;
    $carts =  Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();

    $total_qty = 0;
    if ($carts) {
        foreach($carts as $cart){
            $total_price += $cart->qty * $cart->post->current_amount;
            $total_qty += $cart->qty;
        }
        $states = State::all();
        return view('delivery',compact('states','address','price','cities','total_price','total_qty','carts','posts','categories'));
    }


    return back();
}

public function create_address()
{
    $address = new Address();
     $city = City::where('city',request()->city)->first();
    if ($city&&$city->state_id==request()->state) {
        $address->firstname = request()->FirstName;
        $address->lastname = request()->LastName;
        $address->address = request()->Address;
        $address->phoneno = request()->Phonenumber;
        $address->state = request()->state;
        $address->city = $city->city;
        Auth::user()->address()->save($address);
        return redirect('/payment/delivery');
    }


    return redirect('/payment/delivery')->with(['message'=>'city does not exist']);
}

public function update_address(Address $address)
{
    $city = City::where('city',request()->city)->first();
    if ($city && $city->state_id==request()->state) {
        $address->firstname = request()->FirstName;
        $address->lastname = request()->LastName;
        $address->address = request()->Address;
        $address->phoneno = request()->Phonenumber;
        $address->state = request()->state;
        $address->city = $city->city;
        Auth::user()->address()->save($address);
        return redirect('/payment/delivery');
    }


    return redirect('/payment/delivery')->with(['message'=>'city does not exist']);
}
}



