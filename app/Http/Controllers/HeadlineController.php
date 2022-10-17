<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Headline;
use App\Models\Post_headline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\HeaderBag;

class HeadlineController extends Controller
{
  public function create(Request $request)
  {
    $headline = Headline::where('title',$request->title)->first();
    if ($headline) {
      return back()->with('Headline already exists');
    }
    else{

        $headline = new Headline();
        $headline->title = $request->title;
        $headline->user_id = Auth::user()->id;
        $headline->save();
    }
    $vals =$request->all();
    $count = 0;
    foreach ($vals as $val) {
        if ($count > 1) {
            $post = Post::find($val);
            if ($post) {
                $post_headline = new Post_headline();
                $post_headline->headline_id = $vals['title'];
                $post_headline->post_id = $post->id;
                $post_headline->save();
              }
        }
       ++$count;
    }
 return back();
  }

  public function view()
{
    $headlines = Headline::all();
    $users = User::all();
    $count = 0;
    return view('viewHeadline', compact('headlines','users','count'));
}

public function edit(Headline $headline)
{
    $posts = Post::all();
    return view('editHeadline', compact('headline','posts'));
}

public function fetch(Headline $headline)
{
    $posts = $headline->posts;
    return $posts;
}
public function update(Headline $headline,Request $request)
{
    $db_headline = Headline::where('title',$request->title)->where('id','!=',$headline->id)->first();
    if ($db_headline) {
      return back()->with('Headline already exists');
    }
    else{
        $headline->title = $request->title;
        $headline->save();
    }

    $vals = $request->all();

   // CHECKS IF POST ITEMS ARE IN DB ALREADY AND REMOVES THE ONES IN DB THAT ARE NOT IN THE REQUEST
    $count = 0;
    $condition = false;
    $post_headlines = $headline->posts;
    foreach($post_headlines as $post_head){
        $condition = false;
        foreach ($vals as $val) {
            if ($count > 2) {
                if ($post_head->post_id == $val) {
                    $post = Post::find($post_head->post_id);
                    $string = str_ireplace(' ','',$post->title);
                    unset($vals[$string.$post->id]);
                    $condition = true;
                    break;
                }
            }

           ++$count;
        }

        if (!$condition) {
            $post_head->delete();
        }
    }

    // STORES NEW POST ITEMS THAT ARE NOT IN DB
    $count = 0;
    foreach ($vals as $val) {
        if ($count > 2) {
            $post = Post::find($val);

            if ($post) {
                $post_headline = new Post_headline();
                $post_headline->headline_id = $vals['title'];
                $post_headline->post_id = $post->id;
                $post_headline->save();
              }
        }

       ++$count;
    }

 return redirect()->route('view.Headline');
}

public function destroy(Headline $headline)
{   $headline_posts = $headline->posts;
    foreach ($headline_posts as $headline_post) {
    $headline_post->delete();
    }
    $headline->delete();
    return back();
}
}


