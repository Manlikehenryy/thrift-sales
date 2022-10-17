<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
     $this->middleware('category');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'=>'required',
        ]);
      $category = new Category();
      $file = $request->file('photo');
    $name = str_ireplace(' ','',$file->getClientOriginalName());
     $file->move('images',$name);
      $category->title = $request->title;
      $category->path = $name;
      $category->user_id = Auth::user()->id;
      $category->save();
      session()->flash('message','category was created successfully');
      return back();
    }

    public function view()
    {
      $posts = Post::all();
      $categories = Category::all();
      $users = User::all();
      $count = 0;
     return view('viewCategory', compact('posts','categories','users','count'));
    }

    public function edit(Category $category){
     return view('editCategory',compact('category'));
    }

    public function update(Category $category,Request $request){

          $category->title = $request->title;
          if($request->file('photo')){
            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
             $file->move('images',$name);
             Storage::delete('/public/images/'.$category->path);
             $category->path = $name;

           }
        $category->user_id = Auth::user()->id;
        $category->save();
        session()->flash('message','category was updated successfully');
        return redirect('admin/category/view');
       }

       public function destroy(Category $category){
        $category->delete();
        $posts = Post::where('category_id',$category->id)->get();
        foreach ($posts as $post) {
            $post->delete();
        }
        session()->flash('danger','category was deleted successfully');
        return back();
       }
}
