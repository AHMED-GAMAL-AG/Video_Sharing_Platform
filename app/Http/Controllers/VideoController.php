<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertVideoForStreaming;
use App\Models\ConvertedVideo;
use App\Models\Like;
use App\Models\Video;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'addView']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = auth()->user()->videos->sortByDesc('created_at');
        $title = __('آخر الفيديوهات المرفوعة');

        return view('videos.my-videos', compact('videos', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'video' => 'required',
            'title' => 'required',
            'image' => 'required|image',
        ]);

        $random_path = Str::random(16);

        $video_path = $random_path . '.' . $request->video->getClientOriginalExtension();
        $image_path = $random_path . '.' . $request->image->getClientOriginalExtension();

        // resize the image using Intervention Image

        $image = Image::make($request->image)->resize(320, 180);
        $path = Storage::put($image_path, $image->stream()); // public folder selected in the .env

        $request->video->storeAs('/', $video_path, 'public'); // store the video in public folder

        $video = Video::create([
            'disk' => 'public',
            'video_path' => $video_path,
            'image_path' => $image_path,
            'title' => $request->title,
            'user_id' => auth()->user()->id,
        ]);

        $view = View::create([
            'video_id' => $video->id,
            'user_id' => auth()->id(),
            'views_number' => 0, // when uploading the video, the views number is 0
        ]);

        ConvertVideoForStreaming::dispatch($video); // send the video to the queue

        return redirect()->back()->with('success', __('سيكون مقطع الفيديو متوفر في أسرع وقت عندما ننتهي من معالجته'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        $likes_count = Like::where('video_id', $video->id)->where('liked', '1')->count();
        $dislikes_count = Like::where('video_id', $video->id)->where('liked', '0')->count();

        // check if the user liked or not
        $user = Auth::user();
        if (Auth::check()) {
            $user_like = $user->likes()->where('video_id', $video->id)->first();
        } else {
            $user_like = 0;
        }

        if(Auth::check()){ // add the video to history when the user click on it
            auth()->user()->history()->attach($video->id); // video_user table
        }

        $comments = $video->comments->sortByDesc('created_at');

        return view('videos.show-video', compact('video', 'likes_count', 'dislikes_count', 'user_like', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $video = Video::where('id', $id)->first();

        return view('videos.edit-video', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $video = Video::where('id', $id)->first();

        if ($request->has('image')) { // the image is optional
            $random_path = Str::random(16);
            $new_path = $random_path . '.' . $request->image->getClientOriginalExtension();

            Storage::delete($video->image_path); // delete the old image

            $image = Image::make($request->image)->resize(320, 180);
            $path = Storage::put($new_path, $image->stream());

            $video->image_path = $new_path;
        }

        $video->title = $request->title;
        $video->save();

        return redirect('/videos')->with('success', __('تم تحديث معلومات المقطع بنجاح'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $video = Video::where('id', $id)->first();
        $converted_videos = ConvertedVideo::where('video_id', $id)->get();

        foreach ($converted_videos as $converted_video) { // delete the videos from the s3 bucket
            Storage::delete([
                $converted_video->mp4_Format_240,
                $converted_video->mp4_Format_360,
                $converted_video->mp4_Format_480,
                $converted_video->mp4_Format_720,
                $converted_video->mp4_Format_1080,
                $converted_video->webm_Format_240,
                $converted_video->webm_Format_360,
                $converted_video->webm_Format_480,
                $converted_video->webm_Format_720,
                $converted_video->webm_Format_1080,
                $video->image_path,
            ]);
        }

        $video->delete();

        return back()->with('success', __('تم حذف المقطع بنجاح'));
    }

    /**
     * Search for a video.
     */

    public function search(Request $request)
    {
        $this->validate($request, [
            'term' => 'required',
        ]);

        $videos = Video::where('title', 'LIKE', '%' . $request->term . '%')->paginate(12); // get only 12 videos per page
        $title = __('نتائج البحث عن:') . ' ' . $request->term;

        return view('videos.my-videos', compact('videos', 'title'));
    }

    public function addView(Request $request) // for the views count
    {
        $views = View::where('video_id', $request->videoId)->first(); // the videoId is sent from the ajax request
        $views->views_number++;
        $views->save();

        $viewsNumbers = $views->views_number; // return the views number to the ajax request
        return response()->json(['viewsNumbers' => $viewsNumbers]);
    }
}
