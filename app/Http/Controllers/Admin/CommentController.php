<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\CommentReply;
use App\Http\Controllers\Controller;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comment.index',compact('comments'));
    }


    public function destroy($id)
    {
       $comment = Comment::find($id);
       if ($comment) {
            CommentReply::where('comment_id',$id)->delete();
            $comment->delete();
            Toastr::success('Delete Success');
            return redirect()->back();
       }else{
            Toastr::success('Something Went Wrong');
            return redirect()->back();
       }
    }

    // reply all
    public function replyAll(){
        $replies = CommentReply::latest()->get();
        return view('admin.comment.reply-all',compact('replies'));
    }

    //destroy reply
    public function destroyReply($id){
        $reply = CommentReply::find($id);
       if ($reply) {
            $reply->delete();
            Toastr::success('Delete Success');
            return redirect()->back();
       }else{
            Toastr::success('Something Went Wrong');
            return redirect()->back();
       }
    }




      //get all liked users list
      public function allLikedUsers($post_id){
          $post = Post::find($post_id);
        $users = $post->likedUsers()->get();
        return view('admin.post-like-users.index',compact('users'));
     }
}
