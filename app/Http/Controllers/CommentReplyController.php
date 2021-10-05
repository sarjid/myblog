<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentReplyController extends Controller
{
    //store reply
    public function store(Request $request,$comment_id){
        $request->validate([
            'message' => 'required|max:500'
        ]);
        $comment = new CommentReply();
        $comment->user_id = Auth::id();
        $comment->comment_id = $comment_id;
        $comment->message = $request->message;
        $comment->save();
        return redirect()->back();
        Toastr::success('You Are Replied A Comment');
    }
}
