<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $number_of_videos = Video::count();
        $number_of_channels = User::count(); // channels are users

        // get total views for each channel and take top 5 ordered by total views
        $most_views = View::select('user_id', DB::raw('sum(views.views_number) as total')) // store in total
            ->groupBy('user_id') // channel id
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // to show in the chart.js
        $names = [];
        $total_views = [];
        foreach ($most_views as $view) {
            $channel = User::find($view->user_id);

            array_push($names, $channel->name);
            array_push($total_views, $view->total);
        }

        return view('admin.index', compact('number_of_videos', 'number_of_channels'))->with('names', json_encode($names, JSON_NUMERIC_CHECK))->with('total_views', json_encode($total_views, JSON_NUMERIC_CHECK));
    }

    public function adminIndex() // show the channels
    {
        $users = User::all();
        return view('admin.channels.index', compact('users'));
    }

    public function adminUpdate(Request $request, User $user)
    {
        $request->validate([
            'administration_level' => 'required'
        ]);
        $user->administration_level = $request->administration_level;
        $user->save();

        session()->flash('flash_message', 'تم تحديث الصلاحيات القناة بنجاح');
        return redirect()->route('channels.index');
    }

    public function adminDelete(User $user)
    {
        $user->delete();

        session()->flash('flash_message', 'تم حذف القناة بنجاح');
        return redirect()->route('channels.index');
    }

    public function adminBlock(Request $request, User $user)
    {
        $user->block = 1;
        $user->save();

        session()->flash('flash_message', 'تم حظر القناة بنجاح');
        return redirect()->route('channels.index');
    }

    public function blockedChannels(User $user) // show the blocked channels
    {
        $channels = User::where('block', 1)->get();

        return view('admin.channels.blocked', compact('channels'));
    }

    public function unblock(User $user)
    {
        $user->block = 0;
        $user->save();

        // session()->flash('flash_message', 'تم فك حظر القناة بنجاح');
        // return redirect()->route('channels.blocked');

        return back()->with('flash_message', 'تم فك حظر القناة بنجاح');
    }

    public function allChannels()
    {
        $channels = User::all();

        return view('admin.channels.all', compact('channels'));
    }

    public function topViewed()
    {
        $top_viewed_videos = View::orderBy('views_number', 'desc')
            ->take(10)
            ->get(['video_id', 'views_number', 'user_id']);

        // to show in the chart.js
        $video_names = [];
        $video_views = [];

        foreach ($top_viewed_videos as $view) {
            $video = Video::find($view->video_id);

            array_push($video_names, $video->title);
            array_push($video_views, $view->views_number);
        }

        return view('admin.top-views', compact('top_viewed_videos'))->with('video_names', json_encode($video_names, JSON_NUMERIC_CHECK))->with('video_views', json_encode($video_views, JSON_NUMERIC_CHECK));
    }
}
