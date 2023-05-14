<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_user', function (Blueprint $table) { // pivot table acts as history
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade'); // user who watched the video
            $table->foreignId('video_id')->references('id')->on('videos')->onDelete('cascade'); // video that was watched
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_user');
    }
};
