<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $date = Carbon::now()->subDays(7);
        $title = __('المقاطع الأكثر مشاهدة خلال الأسبوع :');
        $videos = Video::join('views' , 'videos.id' , '=' , 'views.video_id')
            ->orderBy('views.views_number' , 'desc')
            ->where('views.created_at' , '>=' , $date)
            ->take(16)
            ->get('videos.*');

        return view('home', compact('videos', 'title'));
    }

    public function channelVideos(User $channel)
    {

        // $videos = $channel->videos()->paginate(16);
        $videos = Video::where('user_id' , $channel->id)->get();
        $title = __('جميع المقاطع الخاصة بالقناة: :channel', ['channel' => $channel->name]);

        return view('videos.my-videos', compact('videos', 'title'));
    }
}
