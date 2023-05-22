<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $number_of_videos = Video::count();
        $number_of_channels = User::count(); // channels are users

        return view('admin.index' , compact('number_of_videos' , 'number_of_channels'));
    }
}
