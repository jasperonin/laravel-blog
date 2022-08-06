<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store($post_id, Request $request){

        $request->validate([
            'comment' => ' required | min:1 | max:150 '
        ]);

        $this->comment->user_id         = Auth::user()->id; # return the user who created the post
        $this->comment->post_id         = $post_id;         
        $this->comment->body            = $request->comment;
        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id){

        $this->comment->destroy($id);
        return redirect()->back();
    }
}
