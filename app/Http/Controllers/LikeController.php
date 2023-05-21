<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function LikeVideo(Request $request)
    {
        $videoId = $request->videoId; // the videoId from the ajax request
        $isLike = $request->isLike === 'true';
        $update = false;


        $video = Video::find($videoId);
        if (!$video) {
            return null;
        }

        $user = Auth::user();
        $like = $user->likes()->where('video_id', $videoId)->first();

        if ($like) { // if liked the video
            $alreadyLike = $like->like;
            $update = true;
            if ($alreadyLike == $isLike) { // if already liked the video and click like again
                $like->delete();
            }
        } else { // if not liked the video before
            $like = new Like();
        }

        $like->liked = $isLike;
        $like->user_id = $user->id;
        $like->video_id = $video->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }

        $countLike = Like::where('video_id', $video->id)->where('liked', '1')->count();
        $countDislike = Like::where('video_id', $video->id)->where('liked', '0')->count();

        return response()->json([
            'countLike' => $countLike,
            'countDislike' => $countDislike,
        ]);
    }
}
