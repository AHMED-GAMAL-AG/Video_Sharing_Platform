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

        $userName = Auth::user()->name;
        $userImage = Auth::user()->profile_photo_url;
        $commentDate = $comment->created_at->diffForHumans();
        $commentId = $comment->id;

        return response()->json([
            'userName' => $userName,
            'userImage' => $userImage,
            'commentDate' => $commentDate,
            'commentId' => $commentId,
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', __('تم حذف التعليق بنجاح'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->body = $request->comment;
        $comment->save();

        return redirect()->route('videos.show', $comment->video_id)->with('success', __('تم تعديل التعليق بنجاح'));
    }
}
