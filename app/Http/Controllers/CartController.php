<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Cart_Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
    //  $this->middleware('auth');
     $this->middleware('cart');
    }
    public function view(){
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
        $cart_items = null;
        $posts = Post::all();
        $total_qty = 0;
        $latest_posts = DB::table('posts')->orderByDesc('id')->limit('20')->get();
        $categories = Category::all();
        if (Auth::check()&&Auth::user()->role=='customer') {
               $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();

               foreach($carts as $cart){
                   $total_qty += $cart->qty;
               }

            return  view('cartPage',compact('carts','total_qty','cart_items','posts','categories','latest_posts'));
        }
        else if (session()->has('cart')) {
            $cart_items = session('cart')->items;
            return view('cartPage',compact('cart_items','posts','categories','latest_posts','total_qty'));
        } else{
            return view('cartPage',compact('cart_items','posts','categories','latest_posts','total_qty'));
        }
    }


    // CONTROLLER FOR JQUERY AJAX REQUEST
    // public function get_cart_items()
    // {
    //     $carts = null;
    //     $cart_session = null;
    //     if (Auth::check()&&Auth::user()->role==='customer') {
    //         $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
    //     }
    //     elseif (session()->has('cart')) {
    //         $cart_session = session()->get('cart');
    //         $cart_array=[];
    //         $count = 0;
    //         foreach($cart_session->items as $item){
    //             ++$count;
    //           $cart_array['post'.$count] = $item;
    //         }
    //     }
    //     return response(json_encode(['carts'=>$carts,'cart_session'=>$cart_array]),200);
    // }

    public function store($id)
    {     $total_qty = 0;
          $qty = 0;
        if (Auth::check()&&Auth::user()->role==='customer') {
            $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
            $cart = Cart::where('user_id',Auth::user()->id)->where('post_id',$id)->where('status','Active')->first();

            foreach($carts as $cart_item){
                $total_qty += $cart_item->qty;
            }
            $total_qty += 1;

            if (!$cart) {
                $cart = new Cart();
                $cart->post_id = $id;
                $cart->qty = 1;
                $cart->status = 'Active';
                $qty = 1;
            }
            else{
                ++$cart->qty;
                $qty = $cart->qty;
            }
            Auth::user()->carts()->save($cart);
          }
          else{
        $post = Post::find($id);
      $old_cart = session()->has('cart') ? session()->get('cart') : null;
      $cart = new Cart_Session($old_cart);
      $cart->add_cart_item($post,$post->id);
      session(['cart'=> $cart]);
      $total_qty = $cart->total_qty;
      $qty = $cart->items[$id]['qty'];
          }
      return response(['total_qty'=>$total_qty,'qty'=>$qty],200);
    }


    public function decrease($id)
    {
         $total_qty = 0;
          $qty = 0;
        if (Auth::check()&&Auth::user()->role==='customer') {
            $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
            $cart = Cart::where('user_id',Auth::user()->id)->where('post_id',$id)->where('status','Active')->first();

            foreach($carts as $cart_item){
              $total_qty += $cart_item->qty;
          }
          $total_qty -= 1;

            --$cart->qty;
            $qty = $cart->qty;
        if($cart->qty===0){
          $cart->delete();
        }
        else{
            Auth::user()->carts()->save($cart);
        }
      }
      else{
        $post = Post::find($id);
        $old_cart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart_Session($old_cart);
        $cart->minus_cart_item($post,$post->id);
        if ($cart->total_qty < 1) {
          $total_qty = $cart->total_qty;
          $qty=0;
          session()->forget('cart');
        }
        else{
          session(['cart'=> $cart]);
          $total_qty = $cart->total_qty;
          if (isset($cart->items[$id])) {
            $qty = $cart->items[$id]['qty'];
          }
          else{
            $qty = 0;
          }
        }
      }
      return response(['total_qty'=>$total_qty,'qty'=>$qty],200);
    }
    //END OF JQUERY AJAX REQUEST


     // CONTROLLER FOR VIEW(CART) REQUEST
    public function add($id)
    {
        if (Auth::check()&&Auth::user()->role==='customer') {
            $cart = Cart::where('user_id',Auth::user()->id)->where('post_id',$id)->where('status','Active')->first();



            if (!$cart) {
                $cart = new Cart();
                $cart->post_id = $id;
                $cart->qty = 1;
                $cart->status = 'Active';
            }
            else{
                ++$cart->qty;
            }
            Auth::user()->carts()->save($cart);
          }
          else{
        $post = Post::find($id);
      $old_cart = session()->has('cart') ? session()->get('cart') : null;
      $cart = new Cart_Session($old_cart);
      $cart->add_cart_item($post,$post->id);
      session(['cart'=> $cart]);
          }
          session()->flash('message','Ítem added to cart');
      return back();
    }


    public function minus($id)
    {
        if (Auth::check()&&Auth::user()->role==='customer') {
            $cart = Cart::where('user_id',Auth::user()->id)->where('post_id',$id)->where('status','Active')->first();

            --$cart->qty;
        if($cart->qty===0){
          $cart->delete();
        }
        else{
            Auth::user()->carts()->save($cart);
        }
      }
      else{
        $post = Post::find($id);
        $old_cart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart_Session($old_cart);
        $cart->minus_cart_item($post,$post->id);
        if ($cart->total_qty < 1) {
          session()->forget('cart');
        }
        else{
          session(['cart'=> $cart]);
        }
      }
      session()->flash('danger','Ítem removed from cart');

      return back();
    }

    public function remove($id)
    {
        if (Auth::check()&&Auth::user()->role==='customer') {
            $cart = Cart::where('user_id',Auth::user()->id)->where('post_id',$id)->where('status','Active')->first();
            $cart->delete();
          }
          else{
        $post = Post::find($id);
      $old_cart = session()->has('cart') ? session()->get('cart') : null;
      $cart = new Cart_Session($old_cart);
      $cart->delete_cart_item($post,$post->id);
      if ($cart->total_qty < 1) {
        session()->forget('cart');
      }
      else{
        session(['cart'=> $cart]);
          }
        }
        session()->flash('danger','Ítem removed from cart');

      return back();
    }
}
