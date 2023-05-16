<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg as SupportFFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $video;

    public function __construct(Video $video) // get the video model sent from the VideoController
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $low_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(500); // 240p
        $low2_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(900); // 360p
        $medium_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(1500); // 480p
        $high_BitrateFormat = (new X264('aac', 'libx264'))->setKiloBitrate(3000);   // 720p

        $converted_name_240 = '240-' . $this->video->video_path;
        $converted_name_360 = '360p-' . $this->video->video_path;
        $converted_name_480 = '480p-' . $this->video->video_path;
        $converted_name_720 = '720p-' . $this->video->video_path;

        SupportFFMpeg::fromDisk($this->video->disk)
            ->open($this->video->video_path)

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
    }
}
