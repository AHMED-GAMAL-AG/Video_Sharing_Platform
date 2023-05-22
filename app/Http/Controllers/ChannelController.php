<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = User::all()->sortByDesc('created_at'); // channels are the users in the app
        $title = __('أحدث القنوات :');

        return view('channels.index' , compact('channels' , 'title'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'term' => 'required',
        ]);

        $channels = User::where('name' , 'LIKE' , "%{$request->term}%")->paginate(12);
        $title = __('عرض نتائج البحث عن') . ' : ' . $request->term;

        return view('channels.index' , compact('channels' , 'title'));
    }
}
