<?php

namespace App\Jobs;

use App\Events\FailedNotification;
use App\Events\RealNotification;
use App\Models\Alert;
use App\Models\ConvertedVideo;
use App\Models\Notification;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFProbe;
use FFMpeg\Filters\Video\VideoFilters;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
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
        $this->video = $video; // send from the VideoController
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
        $ffprobe = FFProbe::create(); // get the video info to get the width and height
        $video1 = $ffprobe->streams(public_path('/storage//' . $this->video->video_path))->videos()->first();
        $width = $video1->get('width');
        $height = $video1->get('height');

        $media = SupportFFMpeg::fromDisk($this->video->disk)
            ->open($this->video->video_path);

        $durationInSeconds = $media->getDurationInSeconds();

        $hours = floor($durationInSeconds / 3600);
        $minutes = floor(($durationInSeconds / 60) % 60);
        $seconds = $durationInSeconds % 60;

        $quality = 0;



        if ($width > $height) { // landscape

            if (($width >= 1920) && ($height >= 1080)) {
                $quality = 1080;
                $this->convertVideo(0); // loop from 0 to 4 from 1080 to 240
            } elseif (($width >= 1280) && ($height >= 720) && ($width < 1920 && $height < 1080)) {
                $quality = 720;
                $this->convertVideo(1); // loop from 1 to 4 from 720 to 240
            } elseif (($width >= 854) && ($height >= 480) && ($width < 1280 && $height < 720)) {
                $quality = 480;
                $this->convertVideo(2); // loop from 2 to 4 from 480 to 240
            } elseif (($width >= 640) && ($height >= 360) && ($width < 854 && $height < 480)) {
                $quality = 360;
                $this->convertVideo(3); // loop from 3 to 4 from 360 to 240
            } else {
                $quality = 240;
                $this->convertVideo(4); // loop from 4 to 4 from 240 to 240
            }
        } else if ($height > $width) { // portrait

            $this->video->update([
                'Longitudinal' => true // if 1 = portrait if 0 = landscape
            ]);

            if (($height >= 1920) && ($width >= 1080)) {
                $quality = 1080;
                $this->convertVideo(0);
            } elseif (($height >= 1280) && ($width >= 720) && ($height < 1920 && $width < 1080)) {
                $quality = 720;
                $this->convertVideo(1);
            } elseif (($height >= 854) && ($width >= 480) && ($height < 1280 && $width < 720)) {
                $quality = 480;
                $this->convertVideo(2);
            } elseif (($height >= 640) && ($width >= 360) && ($height < 854 && $width < 480)) {
                $quality = 360;
                $this->convertVideo(3);
            } else {
                $quality = 240;
                $this->convertVideo(4);
            }
        }

        Storage::disk('public')->delete($this->video->video_path); // delete the original video that the user uploaded

        $converted_video = new ConvertedVideo;

        for ($i = 0; $i < 5; $i++) { // write the video names in the database in columns mp4_Format_240 , webm_Format_240 etc..
            $converted_video->{'mp4_Format_' . $this->hight[$i]} = $this->names[$i][0]; // index 0 is for mp4 in names array
            $converted_video->{'webm_Format_' . $this->hight[$i]} = $this->names[$i][1]; // index 1 is for webm in names array
        }

        $converted_video->video_id = $this->video->id;

        $converted_video->save();

        // for send notification to the user

        $notification = new Notification;

        $notification->user_id = $this->video->user_id;
        $notification->notification = $this->video->title;
        $notification->save();

        $data = [
            'video_title' => $this->video->title,
        ];

        event(new RealNotification($data));

        // increment the alert column in the alert table
        $alert = Alert::where('user_id', $this->video->user_id)->first(); // select the user's alert from the database
        $alert->alert++;
        $alert->save();

        $this->video->update([
            'processed' => true, // if processed is true then show the video in the website
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $seconds,
            'quality' => $quality,
        ]);
    }

    /**
     * if the job failed
     */
    public function failed()
    {
        $notification = new Notification;
        $notification->notification = $this->video->title;
        $notification->success = false;
        $notification->save();

        $data = [
            'video_title' => $this->video->title,
        ];

        event(new FailedNotification($data));

        $alert = Alert::where('user_id', $this->video->user_id)->first(); // select the user's alert from the database
        $alert->alert++;
        $alert->save();
    }
}
