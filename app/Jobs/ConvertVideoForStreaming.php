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
use FFMpeg\Filters\Video\VideoFilters;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg as SupportFFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $video, $format, $width, $hight, $names, $i; // add $i to use it in convertVideo() in addFilter function

    public function __construct(Video $video) // get the video model sent from the VideoController
    {
        $this->video = $video;
    }

    private function getFileName($filename, $type)
    {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename) . $type; // remove the extension from the file name and add the new extension $type
    }

    protected function convertVideo($loop_count)
    {
        $this->format = [
            [
                (new X264('aac', 'libx264'))->setKiloBitrate(4096), // 1080p mp4
                (new WebM('libvorbis', 'libvpx'))->setKiloBitrate(4096), // 1080p webm
            ],

            [
                (new X264('aac', 'libx264'))->setKiloBitrate(2048), // 720 mp4
                (new WebM('libvorbis', 'libvpx'))->setKiloBitrate(2048), // 720 webm
            ],

            [
                (new X264('aac', 'libx264'))->setKiloBitrate(750), // 480 mp4
                (new WebM('libvorbis', 'libvpx'))->setKiloBitrate(750), // 480 webm
            ],

            [
                (new X264('aac', 'libx264'))->setKiloBitrate(500), // 360 mp4
                (new WebM('libvorbis', 'libvpx'))->setKiloBitrate(500), // 360 webm
            ],

            [
                (new X264('aac', 'libx264'))->setKiloBitrate(300), // 240 mp4
                (new WebM('libvorbis', 'libvpx'))->setKiloBitrate(300), // 240 webm
            ]
        ];

        // 1080, 720, 480, 360, 240
        $this->width = [1920, 1280, 854, 640, 426];
        $this->hight = [1080, 720, 480, 360, 240];

        $this->names = [
            [
                '1080p-' . $this->getFileName($this->video->video_path, '.mp4'), // 1080p mp4
                '1080p-' . $this->getFileName($this->video->video_path, '.webm'), // 1080p webm
            ],

            [
                '720p-' . $this->getFileName($this->video->video_path, '.mp4'), // 720p mp4
                '720p-' . $this->getFileName($this->video->video_path, '.webm'), // 720p webm
            ],

            [
                '480p-' . $this->getFileName($this->video->video_path, '.mp4'), // 480p mp4
                '480p-' . $this->getFileName($this->video->video_path, '.webm'), // 480p webm
            ],

            [
                '360p-' . $this->getFileName($this->video->video_path, '.mp4'), // 360p mp4
                '360p-' . $this->getFileName($this->video->video_path, '.webm'), // 360p webm
            ],

            [
                '240p-' . $this->getFileName($this->video->video_path, '.mp4'), // 240p mp4
                '240p-' . $this->getFileName($this->video->video_path, '.webm'), // 240p webm
            ]

        ];

        for ($this->i = $loop_count; $this->i < 5; $this->i++) { // 5 is the count of resolutions in format,names
            for ($j = 0; $j < 2; $j++) { // 2 is the number of formats mp4 ,webm in format,names
                SupportFFMpeg::fromDisk($this->video->disk)
                    ->open($this->video->video_path)
                    ->export()
                    ->toDisk(env('FILESYSTEM_DISK'))
                    ->inFormat($this->format[$this->i][$j])
                    ->addFilter(function (VideoFilters $filters) {
                        $filters->resize(new Dimension($this->width[$this->i], $this->hight[$this->i]));
                    })
                    ->save($this->names[$this->i][$j]);
            }
        }
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
