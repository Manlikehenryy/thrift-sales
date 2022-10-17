<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\State;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitiesImport;
use App\Models\Address;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test',function()
{
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

        return  view('test',compact('carts','total_qty','cart_items','posts','categories','latest_posts'));
    }
    else if (session()->has('cart')) {
        $cart_items = session('cart')->items;
        return view('test',compact('cart_items','posts','categories','latest_posts','total_qty'));
    } else{
        return view('test',compact('cart_items','posts','categories','latest_posts','total_qty'));
    }
});
Route::get('/email',function(){
    $data = [
        'title' => 'E-commerce',
         'content' => 'Item has been purchased, you have $100 in your account'
    ];

    Mail::send('email', $data, function ($message) {
        // $message->from('no-reply@ecommerce.com', 'Ecommerce');
        $message->to('mbamaluhenry8@gmail.com', 'John Doe');
        // $message->cc('john@johndoe.com', 'John Doe');
        // $message->bcc('john@johndoe.com', 'John Doe');
        // $message->replyTo('john@johndoe.com', 'John Doe');
        $message->subject('NOTICE');
        $message->priority(1);
        // $message->attach('images/bin.png');
    });

});

Route::get('/change/password',function()
{
   if (Auth::check()) {
    $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
    $total_qty = 0;
    $posts = Post::all();
    $categories = Category::all();
    foreach($carts as $cart){
        $total_qty += $cart->qty;
    }
  return view('changePassword',compact('total_qty','posts','categories'));
   }
   else{
    return back();
   }
}

)->name('view.change.password');
Route::post('/change/password', function (Request $request)
{
    if (Auth::check()) {
        $request->validate(
            ['password'=>'required|confirmed|min:8',
            'prev_password'=>'required',
            ]);

         if (Hash::check($request->prev_password,Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('message','password changed successfully');
            return back();
         }
         else{
            session()->flash('danger','The password you entered is incorrect');
            return back();
         }
    }
    else{
        return back();
    }
})->name('change.password');

Route::get('shop/item/{id}',function($id){
    $post = Post::find($id);
    $posts = Post::all();
    $categories = Category::all();
    $cart_qty = null;
    $cart_session = null;
    $recently_viewed = session()->has('views')?session('views'):[];
    $latest_posts = DB::table('posts')->orderByDesc('id')->limit('20')->get();
    if (count($recently_viewed)>0) {
        for ($i=0; $i < count($recently_viewed); $i++) {
            if (isset($recently_viewed[$i])&&$recently_viewed[$i]->id==$id){
                unset($recently_viewed[$i]);
            }
        }
    }
    array_unshift($recently_viewed,$post);
    session(['views'=>$recently_viewed]);
    if(Auth::check()&&Auth::user()->role === 'admin'){
        return redirect('/');
    }
   if ($post?->category !== null) {
    $links = session()->has('links') ? session('links') : [];
    $currentLink = request()->path(); // Getting current URI like 'category/books/'
    array_unshift($links, $currentLink); // Putting it in the beginning of links array
    session(['links' => $links]); // Saving links array to the session
    $total_qty = null;
    if (Auth::check()) {
       $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
       $cart_item = Cart::where('user_id',Auth::user()->id)->where('status','Active')->where('post_id',$id)->get();
       $total_qty = 0;
       foreach($carts as $cart){
           $total_qty += $cart->qty;
       }
       if ($cart_item) {
        foreach($carts as $cart){
            $cart_qty = $cart_item->qty;
        }
      }
    }
     else{
      $cart_session = session()->has('cart') ? session('cart')->items:null;
     }
    return view('shopItem',compact('post','total_qty','posts','categories','cart_qty','cart_session','latest_posts'));
   }
   else{
    return redirect('/');
   }
});

Route::get('/browse/categories/{cat}',function ($cat)
{
    $links = session()->has('links') ? session('links') : [];
    $currentLink = request()->path(); // Getting current URI like 'category/books/'
    array_unshift($links, $currentLink); // Putting it in the beginning of links array
    session(['links' => $links]); // Saving links array to the session
   $categories = Category::all();
   $posts = Post::all();
   $total_qty = null;
   $cart_array = [];
   $cart_session = null;
   if (Auth::check()) {
      $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
      $total_qty = 0;
      foreach($carts as $cart){
          $total_qty += $cart->qty;
      }
      if ($carts) {
        foreach($carts as $cart){
            $cart_array[$cart->post_id] = $cart->qty;
        }
      }
   }
   else{
    $cart_session = session()->has('cart') ? session('cart')->items:null;
   }

  return view('browseCategories',compact('categories','posts','total_qty','cat','cart_array','cart_session'));
});

Route::get('/', function () {
    $links = session()->has('links') ? session('links') : [];
    $currentLink = request()->path(); // Getting current URI like 'category/books/'
    array_unshift($links, $currentLink); // Putting it in the beginning of links array
    session(['links' => $links]); // Saving links array to the session
    $posts = Post::all();
      $total_qty = null;
     if (Auth::check()) {
        $carts = Cart::where('user_id',Auth::user()->id)->where('status','Active')->get();
        $total_qty = 0;
        foreach($carts as $cart){
            $total_qty += $cart->qty;
        }
     }
    $categories = Category::all();
    $latest_posts = DB::table('posts')->orderByDesc('id')->limit('20')->get();
    return view('home',compact('posts','categories','total_qty','latest_posts'));
});


Route::get('/user/orders',[UserController::class,'orders'])->name('user.orders');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/login',[LoginController::class,'auth'])->name('login');
Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('/register',[LoginController::class,'create_user'])->name('register');

// Route::middleware('auth')->group(function(){
    Route::get('admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('admin/create-post',[AdminController::class,'create_post'])->name('admin.create.post');
    Route::get('admin/create-category',[AdminController::class,'create_category'])->name('admin.create.category');
    Route::get('admin/create-headline',[AdminController::class,'create_Headline'])->name('admin.create.Headline');
    Route::get('admin/create-admin',[AdminController::class,'view_create_admin'])->name('view.create.admin');
    Route::post('admin/create-admin',[AdminController::class,'create_admin'])->name('admin.create.admin');
    Route::get('admin/view/orders',[AdminController::class,'view_orders'])->name('admin.view.orders');
    Route::get('admin/view/users',[AdminController::class,'view_users'])->name('admin.view.users');
    Route::get('/update/status/{id}/{status}',[AdminController::class,'update_status']);
    Route::get('admin/view/order/{order}',[AdminController::class,'view_orders_details'])->name('admin.view.order.details');
    Route::get('admin/create-city',[AdminController::class,'create_city'])->name('admin.create.city');
    Route::get('admin/post/{id}/delete/image/{path}',[PostsController::class,'delete_additional_image']);
    Route::post('admin/post/create',[PostsController::class,'create'])->name('post.create');
    Route::get('admin/post/{post}/edit',[PostsController::class,'edit'])->name('post.edit');
    Route::delete('admin/post/{post}/destroy',[PostsController::class,'destroy'])->name('post.destroy');
    Route::get('admin/post/view',[PostsController::class,'view'])->name('view.post');
    Route::patch('admin/post/{post}/update',[PostsController::class,'update'])->name('post.update');
    Route::post('admin/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::get('admin/category/view',[CategoryController::class,'view'])->name('view.category');
    Route::get('admin/category/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::patch('admin/category/{category}/update',[CategoryController::class,'update'])->name('category.update');
    Route::delete('admin/category/{category}/destroy',[CategoryController::class,'destroy'])->name('category.destroy');
    Route::post('admin/Headline/create',[HeadlineController::class,'create'])->name('Headline.create');
    Route::get('admin/Headline/view',[HeadlineController::class,'view'])->name('view.Headline');
    Route::get('admin/headline/{headline}/edit',[HeadlineController::class,'edit'])->name('headline.edit');
    Route::patch('admin/headline/{headline}/update',[HeadlineController::class,'update'])->name('headline.update');
    Route::delete('admin/headline/{headline}/destroy',[HeadlineController::class,'destroy'])->name('headline.destroy');
    Route::get('admin/headline/{headline}/fetch',[HeadlineController::class,'fetch'])->name('headline.fetch');
    Route::get('admin/city/view',[CityController::class,'view'])->name('view.city');
    Route::post('admin/city/create',[CityController::class,'create'])->name('create.city');
    Route::get('admin/city/{city}/edit',[CityController::class,'edit'])->name('edit.city');
    Route::patch('admin/city/{city}/update',[CityController::class,'update'])->name('update.city');
    Route::delete('admin/city/{city}/destroy',[CityController::class,'destroy'])->name('destroy.city');

    Route::get('store/cart/{id}/item',[CartController::class,'store']);
    Route::get('decrease/cart/{id}/item',[CartController::class,'decrease']);
    Route::get('get/cart/item',[CartController::class,'get_cart_items']);

    Route::get('cart/store/{id}/item',[CartController::class,'add'])->name('store.cart.item');
    Route::get('cart/decrease/{id}/item',[CartController::class,'minus'])->name('decrease.cart.item');
    Route::get('remove/cart/{id}/item',[CartController::class,'remove'])->name('remove.cart.item');

// });
Route::get('/cart', [CartController::class,'view'])->name('view.cart.item');

// Laravel 8 & 9
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'make_payment'])->name('pay');
Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('checkout');
Route::get('/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('pay.callback');
Route::get('/payment/delivery',[App\Http\Controllers\PaymentController::class, 'delivery'])->name('checkout.cart');
Route::post('/create/address',[App\Http\Controllers\PaymentController::class, 'create_address']);
Route::patch('/update/address/{address}',[App\Http\Controllers\PaymentController::class, 'update_address']);
Route::get('/store/city',function ()
{
  $city = new City();
  $city->city = 'Akoko Edo';
  $city->state_id = 'Edo';
  $city->price = 3000;
  $city->save();
  return 'y';
});
Route::get('/state',function ()
{
    $state = new State();
    $state->state = 'Lagos';

    $state->save();
  return 'y';
});

Route::get('get/cities/{region}',function($region){
 $state = State::where('state',$region)->first();
//  $state = State::find(2);
 $cities = $state->cities;
 return $cities;
});

Route::post('/excel', function () {
    Excel::import(new CitiesImport, request()->file('excel'));
});

Route::get('/upload/cities',function(){
return view('citiesUpload');
});


