<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\CommentReply;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::latest()->where('user_id',Auth::id())->get();
        return view('user.comment.index',compact('comments'));
    }


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == Auth::id()) {
            CommentReply::where('comment_id',$id)->delete();
            $comment->delete();
            Toastr::success('Comment successfully deleted :)');
            return redirect()->back();
        } else {
            Toastr::error('You can not delete this comment :(');
            return redirect()->back();
        }
    }

    // reply all
    public function replyAll(){
        $replies = CommentReply::latest()->get();
        return view('user.comment.reply-all',compact('replies'));
    }

    //destroy reply
    public function destroyReply($id){
        $reply = CommentReply::find($id);
        if ($reply->user_id == Auth::id()) {
            $reply->delete();
            Toastr::success('Delete Success');
            return redirect()->back();
       }else{
            Toastr::success('Something Went Wrong');
            return redirect()->back();
       }
    }
}
