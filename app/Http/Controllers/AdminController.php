<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\State;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
    $this->middleware('admin');
   }

    public function index(){
            return view('dashboard');
    }

    public function create_post(){
           $categories = Category::all();
            return view('createPost', compact('categories'));
    }

    public function create_category(){
             return view('createCategory');
    }
    public function create_Headline()
    {
            $posts = Post::all();
           return view('createHeadline',compact('posts'));
    }

    public function create_city(){
        $states = State::all();
        return view('createCity',compact('states'));
}

public function view_create_admin(){

    return view('createAdmin');
}

public function create_admin(Request $request)
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
        $user->role = 'admin';
        $user->save();
        session()->flash('message','Admin has been created successfully');
        return back();
    }




}

public function view_orders()
{
  $orders = Order::all();
  $count = 0;
  return view('viewOrders',compact('orders','count'));
}

public function view_orders_details(Order $order)
{
    return view('viewOrderDetails',compact('order'));
}
public function update_status($id,$status)
{
    $order = Order::find($id);
    if ($status==='Delivery in Progress'||$status==='Delivered') {
        $order->status = $status;
        $order->save();

        return 'Updated successfully';
    }
    else{
        return 'Enter valid status';
    }

}

public function view_users()
{   $count = 0;
    $users = User::all();
    return view('viewUsers',compact('users','count'));
}

}
