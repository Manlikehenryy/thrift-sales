<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Headline;
use App\Models\Post_headline;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
     $this->middleware('post');
    }


  public function create(Request $request){

     $request->validate([
        'title'=> 'required',
        'image'=>'required',
        'category'=>'required',
        'curr_amount'=>'required'
    ]);

    $post = new Post();

    $file = $request->file('image');
    $name = str_ireplace(' ','',$file->getClientOriginalName());
     $file->move('images',$name);

     if ($request->file('image2')) {
        $file2 = $request->file('image2');
        $name2 = str_ireplace(' ','',$file2->getClientOriginalName());
         $file2->move('images',$name2);
         $post->path2 = $name2;
    }

    if ($request->file('image3')) {
        $file3 = $request->file('image3');
        $name3 = str_ireplace(' ','',$file3->getClientOriginalName());
         $file3->move('images',$name3);
         $post->path3 = $name3;
    }

    $post->title = $request->title;
    $post->description = $request->description?$request->description:null;
    $post->old_amount = $request->prev_amount;
    $post->current_amount = $request->curr_amount;
    $post->path = $name;
    $post->category_id = $request->category;
    $post->user_id = Auth::user()->id;
     $post->save();
     session()->flash('message','Post has been created successfully');
    return back();
  }

  public function view()
  {
    $posts = Post::all();
    $categories = Category::all();
    $users = User::all();
    $count = 0;
   return view('viewPost', compact('posts','categories','users','count'));
  }

  public function update(Post $post,Request $request){
    $request->validate([
       'title'=> 'required',
       'category'=>'required',
       'curr_amount'=>'required'
   ]);
   if($request->file('image')){
    $file = $request->file('image');
    $name = $file->getClientOriginalName();
     $file->move('images',$name);
     Storage::delete('/public/images/'.$post->path);
     $post->path = $name;

   }
   if ($request->file('image2')) {
    $file2 = $request->file('image2');
    $name2 = str_ireplace(' ','',$file2->getClientOriginalName());
     $file2->move('images',$name2);
     if ($post->path2) {
        Storage::delete('/public/images/'.$post->path2);
     }
     $post->path2 = $name2;
}

if ($request->file('image3')) {
    $file3 = $request->file('image3');
    $name3 = str_ireplace(' ','',$file3->getClientOriginalName());
     $file3->move('images',$name3);
     if ($post->path3) {
        Storage::delete('/public/images/'.$post->path3);
     }
     $post->path3 = $name3;
}


  if($request->prev_amount){
    $post->old_amount = $request->prev_amount;
  }
   $post->title = $request->title;
   $post->description = $request->description?$request->description:null;
   $post->current_amount = $request->curr_amount;
   $post->category_id = $request->category;
   $post->user_id = Auth::user()->id;
    $post->save();
    session()->flash('message','Post has been updated successfully');

   return redirect('admin/post/view');
 }

  public function destroy(Post $post)
  {
    $post_headline = Post_headline::where('post_id',$post->id);
    $post_headline->delete();
    $carts = $post->carts;
    foreach ($carts as $cart) {
        $cart->delete();
    }
   $post->delete();
   session()->flash('danger','Post has been deleted successfully');

   return back();
  }

  public function edit(Post $post)
  {
    $categories = Category::all();
   return view('editPost',compact('post','categories'));
  }


public function delete_additional_image($id,$path)
{
   if (Auth::user()->role==='admin') {
     $post = Post::find($id);
    //  if (Auth::user()->id===$post->user_id) {
        if ($path=='path2') {
            $post->path2 = null;
         }
         elseif($path=='path3'){
            $post->path3 = null;
         }
         $post->save();
         return response('image has been deleted',200);
    //  }
    //  else{
    //     return response('Not authorized',200);
    //  }
   }
   else{
    return response('Not authorized',200);
 }
}
}
