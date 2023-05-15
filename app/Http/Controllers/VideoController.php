<?php

namespace App\Http\Controllers;

use App\Models\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg as SupportFFMpeg;

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

        $request->video->storeAs('/', $video_path, 'public'); // store the video in public folder

        $video = Video::create([
            'disk' => 'public',
            'video_path' => $video_path,
            'image_path' => $image_path,
            'title' => $request->title,
            'user_id' => auth()->user()->id,
        ]);

        $low_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(500); // 240p
        $low2_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(900); // 360p
        $medium_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(1500); // 480p
        $high_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(3000);   // 720p

        $converted_name_240 = '240-' . $video->video_path;
        $converted_name_360 = '360p-' . $video->video_path;
        $converted_name_480 = '480p-' . $video->video_path;
        $converted_name_720 = '720p-' . $video->video_path;

        SupportFFMpeg::fromDisk($video->disk)
            ->open($video->video_path)

            ->addFilter(function ($filters) { // 240p
                $filters->resize(new Dimension(426, 240));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($low_BitrateFormat)
            ->save($converted_name_240)

            ->addFilter(function ($filters) { // 360p
                $filters->resize(new Dimension(640, 360));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($low2_BitrateFormat)
            ->save($converted_name_360)

            ->addFilter(function ($filters) { // 480p
                $filters->resize(new Dimension(854, 480));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($medium_BitrateFormat)
            ->save($converted_name_480)

            ->addFilter(function ($filters) { // 720p
                $filters->resize(new Dimension(1280, 720));
            })
            ->export()
            ->toDisk('public')
            ->inFormat($high_BitrateFormat)
            ->save($converted_name_720);

        return redirect()->back()->with('success', __('سيكون مقطع الفيديو متوفر في أقصر وقت عندما ننتهي من معالجته'));
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
