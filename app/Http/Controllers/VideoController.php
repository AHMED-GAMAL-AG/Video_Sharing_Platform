<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $request->video->storeAs('/', $video_path , 'public'); // store the video in public folder

        $video = Video::create([
            'disk' => 'public',
            'video_path' => $video_path,
            'image_path' => $image_path,
            'title' => $request->title,
            'user_id' => auth()->user()->id,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
