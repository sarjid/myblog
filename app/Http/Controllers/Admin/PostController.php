<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\NewPost;
use App\Post;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user','category'])->orderBy('id','DESC')->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif',
        ]);
        if ($request->has('image')) {
            $image = $request->image;
            $imgName = Str::slug($request->input('title'),'-').uniqid().'.'.$image->getClientOriginalExtension();

            //create directory
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //image cropped
            $img = Image::make($image)->resize(752, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();

            Storage::disk('public')->put('post/'.$imgName,$img);
            // Storage::put('public/ads/'., $contents);
         }

         $slug = Str::slug($request->input('title'));
         $post = new Post();
         $post->title = $request->title;
         $post->slug = $slug;
         $post->user_id = Auth::id();
         $post->category_id = $request->category_id;
         $post->image = $imgName;
         $post->body = $request->body;
         if ($request->status) {
            $post->status = 1;
         }else {
            $post->status = 0;
         }
         $post->save();

         //notification email
         if ($post->status) {
             //send all users 
             $users = User::all();
             foreach ($users as $user) {
                Mail::to($user->email)->queue(new NewPost($post));
             }
         }

         //insert into tags table
         $tags = [];
         $stringTags = array_map('trim',explode(',',$request->tags)); //array maps delete space in tags
         foreach ($stringTags as $tag) {
             array_push($tags, ['name' => $tag]);
         }
         $post->tags()->createMany($tags);
         Toastr::success('Post Added Success');
         return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('category')->find($id);
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        return view('admin.post.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif',
        ]);

        $post = Post::find($id);
        if ($request->has('image')) {
            $image = $request->image;
            $imgName = Str::slug($request->input('title'),'-').uniqid().'.'.$image->getClientOriginalExtension();

            //create directory
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //image cropped
            $img = Image::make($image)->resize(752, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();

            Storage::disk('public')->put('post/'.$imgName,$img);
              //delete old image
              if (Storage::disk('public')->exists('post/'.$post->image)) {
                Storage::disk('public')->delete('post/'.$post->image);
            }

            $post->image = $imgName;

         }


         $slug = Str::slug($request->input('title'));
         $post->title = $request->title;
         $post->slug = $slug;
         $post->user_id = Auth::id();
         $post->category_id = $request->category_id;
         $post->body = $request->body;
          if ($request->status) {
            $post->status = 1;
         }else {
            $post->status = 0;
         }
         $post->save();

         //notification email
         if ($post->status) {
            //send all users 
            $users = User::all();
            foreach ($users as $user) {
               Mail::to($user->email)->queue(new NewPost($post));
            }
        }
        
         //insert into tags table
         //delete old tag
         $post->tags()->delete();
         $tags = [];
         $stringTags = array_map('trim',explode(',',$request->tags)); //array maps delete space in tags
         foreach ($stringTags as $tag) {
             array_push($tags, ['name' => $tag]);
         }
         $post->tags()->createMany($tags);

         Toastr::success('Post Update Success');
         return redirect()->route('post.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            if (Storage::disk('public')->exists('post/'.$post->image)) {
                Storage::disk('public')->delete('post/'.$post->image);
            }
            // tags delete
           $post->tags()->delete();
           $post->delete();
        }
        Toastr::success('Delete Success');
        return redirect()->back();
          //delete old image

    }
}
