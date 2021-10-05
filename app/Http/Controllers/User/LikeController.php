<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($post_id){
        if (Auth::check()) {
           $user = Auth::user();
           $likePost = $user->likedPosts()->where('post_id',$post_id)->count();
            if ($likePost == 0) {
                $user->likedPosts()->attach($post_id);
            }else {
                $user->likedPosts()->detach($post_id);
            }
            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }


    // my all like posts list
    public function likeList(){
        $posts = Auth::user()->likedPosts()->get();
        return view('user.liked-posts',compact('posts'));
    }
}
