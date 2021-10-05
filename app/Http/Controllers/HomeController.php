<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->published()->take(6)->get();
        return view('frontend.index',compact('posts'));
    }

    //all post
    public function posts(){
        $posts = Post::latest()->published()->paginate(10);
        return view('frontend.posts',compact('posts'));
    }

    //single post view
    public function post($slug){
        $post = Post::where('slug',$slug)->published()->first();
        if ($post) {
            $postKey = 'post_'.$post->id;
            //view count increment
            if(!Session::has($postKey)){
                $post->increment('view_count');
                Session::put($postKey,1);
            }
            return view('frontend.single-post',compact('post'));
        }
        abort(404);

    }

    //category page
    public function categories(){
        $categories = Category::orderBy('name','ASC')->get();
        return view('frontend.category',compact('categories'));
    }


    //category wise post show
    public function categoryPost($slug){
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->published()->latest()->paginate(10);
        return view('frontend.category-post',compact('category','posts'));
    }


    //search
    public function search(Request $request){
        $request->validate(['search'=> 'required']);
        $search = $request->search;
        $posts = Post::where('title','LIKE',"%$search%")->paginate(10);
        $posts->appends(['search' => $search]);
        return view('frontend.search',compact('posts','search'));
    }


    //tag posts
    public function tagPosts($name){
        $query = $name;
        $tags = Tag::where('name','LIKE',"%$name%")->paginate(10);
        $tags->appends(['query' => $query]);
        return view('frontend.tag-posts',compact('tags','query'));
    }
}
