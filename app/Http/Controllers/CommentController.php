<?php

namespace App\Http\Controllers;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request,$post_id){
        $request->validate([
            'comment' => 'required|max:255'
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post_id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();
        Toastr::success('Thanks For Your Comment');
    }


}
