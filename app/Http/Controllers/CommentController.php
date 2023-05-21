<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function saveComment(Request $request)
    {
        $videoId = $request->videoId; // the videoId from the ajax request
        $userComment = $request->comment; // the userComment from the ajax request

        $comment = new Comment();

        $comment->user_id = Auth::user()->id;
        $comment->video_id = $videoId;
        $comment->body = $userComment;

        $comment->save();
    }
}
