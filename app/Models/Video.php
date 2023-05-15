<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;


    protected $fillable = [
        'disk',
        'video_path',
        'image_path',
        'title',
        'user_id',
    ];

    public function user() // upload a video belongs to a user
    {
        return $this->belongsTo(User::class);
    }

    public function convertedVideos() // can convert to many formats
    {
        return $this->hasMany(ConvertedVideo::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function users() // user can watch many videos
    {
        return $this->belongsToMany(Video::class , 'video_user' , 'video_id' , 'user_id')->withTimestamps()->withPivot('id'); // video_user pivot table user can watch many videos and video can be watched by many users
    }
}
