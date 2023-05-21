@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col-9">
                <input id="videoId" type="hidden" value="{{ $video->id }}">

                <div class='video-container'>
                    @foreach ($video->convertedVideos as $video_converted)
                        <video id="videoPlayer" controls style='{{ $video->Longitudinal == '0' ? 'width: 100%; height: 90%;' : 'width: 900px; height: 510px;' }}'>
                            @if ($video->quality == 1080)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_1080) }}" type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_1080) }}" type="video/mp4">
                            @elseif($video->quality == 720)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_720) }}" type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_720) }}" type="video/mp4">
                            @elseif($video->quality == 480)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_480) }}" type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_480) }}" type="video/mp4">
                            @elseif($video->quality == 360)
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_360) }}" type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_360) }}" type="video/mp4">
                            @else
                                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_240) }}" type="video/webm">
                                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_240) }}" type="video/mp4">
                            @endif
                        </video>
                    @endforeach
                </div>
                <select id='qualityPick'>
                    <option value="1080" {{ $video->quality == 1080 ? 'selected' : '' }} {{ $video->quality < 1080 ? 'hidden' : '' }}>1080p</option>
                    <option value="720" {{ $video->quality == 720 ? 'selected' : '' }} {{ $video->quality < 720 ? 'hidden' : '' }}>720p</option>
                    <option value="480" {{ $video->quality == 480 ? 'selected' : '' }} {{ $video->quality < 480 ? 'hidden' : '' }}>480p</option>
                    <option value="360" {{ $video->quality == 360 ? 'selected' : '' }} {{ $video->quality < 360 ? 'hidden' : '' }}>360p</option>
                    <option value="240" {{ $video->quality == 240 ? 'selected' : '' }}>240p</option>
                </select>
                <div class="title mt-3">
                    <h5>
                        {{ $video->title }}
                    </h5>
                </div>

                <div class="interaction text-center mt-5">
                    <a href="#" class="like ml-3">
                        @if ($user_like)
                            @if ($user_like->like == 1)
                                <i class="far fa-thumbs-up fa-2x liked"></i> <span id="likeNumber">{{ $likes_count }}</span>
                            @else
                                <i class="far fa-thumbs-up fa-2x"></i> <span id="likeNumber">{{ $likes_count }}</span>
                            @endif
                        @else
                            <i class="far fa-thumbs-up fa-2x"></i> <span id="likeNumber">{{ $likes_count }}</span>
                        @endif

                    </a> |
                    <a href="#" class="like mr-3">
                        @if ($user_like)
                            @if ($user_like->like == 0)
                                <i id="like_down" class="far fa-thumbs-down fa-2x liked"></i> <span id="dislikeNumber">{{ $dislikes_count }}</span>
                            @else
                                <i id="like_down" class="far fa-thumbs-down fa-2x"></i> <span id="dislikeNumber">{{ $dislikes_count }}</span>
                            @endif
                        @else
                            <i id="like_down" class="far fa-thumbs-down fa-2x"></i> <span id="dislikeNumber">{{ $dislikes_count }}</span>
                        @endif
                    </a>

                    @foreach ($video->views as $view)
                        <span class="float-right"> {{ __('عدد المشاهدات') }}<span class="viewsNumber mr-2">{{ $view->views_number }}</span></span>
                    @endforeach

                    <div class="loginAlert mt-5">

                    </div>
                </div>

                {{-- Comments --}}
                <div class="mt-4 px-2">
                    <div class="comments">
                        <div class="mb-3">
                            <span>{{ __('التعليقات') }}</span>
                        </div>
                        <div>
                            <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="إضافة تعليق عام"></textarea>
                            <button type="submit" class="btn btn-info mt-3 saveComment">{{ __('تعليق') }}</button>

                            <div class="commentAlert mt-5">

                            </div>

                            <div class="commentBody">
                                @foreach ($comments as $comment)
                                    <div class="card mt-5 mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="{{ $comment->user->profile_photo_url }}" width="150px" class="rounded-full" />
                                                </div>
                                                <div class="col-10">
                                                    @if (Auth::check())
                                                        @if ($comment->user_id == auth()->user()->id || auth()->user()->administration_level > 0)
                                                            <form method="GET" action="{{ route('comment.destroy', $comment->id) }}" onsubmit="return confirm('{{ __('هل أنت متأكد أنك تريد حذف التعليق هذا؟') }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="float-left"><i class="far fa-trash-alt text-danger fa-lg"></i></button>
                                                            </form>

                                                            <form method="GET" action="{{ route('comment.edit', $comment->id) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="float-left"><i class="far fa-edit text-success fa-lg ml-3"></i></button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                    <p class="mt-3 mb-2"><strong>{{ $comment->user->name }}</strong></p>
                                                    <i class="far fa-clock"></i> <span class="comment_date text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
                                                    <p class="mt-3">{{ $comment->body }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('script')
    {{-- for changing video quality --}}
    <script>
        document.getElementById("qualityPick").onchange = function() {
            changeQuality()
        };

        function changeQuality() {
            var video = document.getElementById("videoPlayer");
            curTime = video.currentTime; // save the current time of the video so the video doesn't restart over again
            var selected = document.getElementById("qualityPick").value;

            if (selected == '1080') {
                source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_1080) }}";
                source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_1080) }}";
            } else if (selected == '720') {
                source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_720) }}";
                source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_720) }}";
            } else if (selected == '480') {
                source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_480) }}";
                source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_480) }}";
            } else if (selected == '360') {
                source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_360) }}";
                source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_360) }}";
            } else if (selected == '240') {
                source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_240) }}";
                source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_240) }}";
            }

            video.load();
            video.play();
            video.currentTime = curTime; // start playing the video from where the quality was changed

        }
    </script>

    {{-- for liking and disliking --}}
    <script>
        $('.like').on('click', function(event) {
            var token = '{{ Session::token() }}';
            var urlLike = '{{ route('like') }}';

            var videoId = 0;

            var AuthUser = "{{ Auth::user() ? 0 : 1 }}";

            if (AuthUser == '1') { // log in alert
                event.preventDefault();
                var html = '<div class="alert alert-danger">\
                                                                                                                            <ul>\
                                                                                                                                <li class="loginAlert">يجب تسجيل الدخول لكي تستطيع الإعجاب بالفيديو</li>\
                                                                                                                            </ul>\
                                                                                                                        </div>';
                $(".loginAlert").html(html);
            } else {
                event.preventDefault(); // to prevent the page from going up when clicking on the like button
                videoId = $("#videoId").val();
                var isLike = event.target.parentNode.previousElementSibling == null;
                $.ajax({
                    method: 'POST',
                    url: urlLike,
                    data: {
                        isLike: isLike,
                        videoId: videoId,
                        _token: token
                    },
                    success: function(data) {
                        if ($(event.target).hasClass('fa-thumbs-up')) {
                            if ($(event.target).hasClass('liked')) {
                                $(event.target).removeClass("liked");
                            } else {
                                $(event.target).addClass("liked");
                            }

                            $('#likeNumber').html(data.countLike);
                            $('#dislikeNumber').html(data.countDislike);
                        }

                        if ($(event.target).hasClass('fa-thumbs-down')) {
                            if ($(event.target).hasClass('liked')) {
                                $(event.target).removeClass("liked");
                            } else {
                                $(event.target).addClass("liked");
                            }
                            $('#likeNumber').html(data.countLike);
                            $('#dislikeNumber').html(data.countDislike);
                        }
                        if (isLike) {
                            $(".fa-thumbs-down").removeClass("liked");
                        } else {
                            $(".fa-thumbs-up").removeClass("liked");
                        }
                    }
                })
            }
        });
    </script>

    {{-- when watching a full video change the view count --}}
    <script>
        $('#videoPlayer').on('ended', function(e) {
            var token = '{{ Session::token() }}';
            var urlComment = '{{ route('view') }}';
            event.preventDefault();
            videoId = $("#videoId").val();

            $.ajax({
                method: 'POST',
                url: urlComment,
                data: {
                    videoId: videoId,
                    _token: token
                },
                success: function(data) {
                    $(".viewsNumber").html(data.viewsNumbers);
                }
            })
        });
    </script>

    {{-- for adding comments --}}
    <script>
        $('.saveComment').on('click', function(event) {
            var token = '{{ Session::token() }}';
            var urlComment = '{{ route('comment') }}';

            var videoId = 0;

            var AuthUser = "{{ Auth::user() ? 0 : 1 }}";

            if (AuthUser == '1') { // if user is authenticated
                event.preventDefault();
                var html = '<div class="alert alert-danger">\
                                                                <ul>\
                                                                    <li>يجب تسجيل الدخول لكي تستطيع التعليق على الفيديو</li>\
                                                                </ul>\
                                                            </div>';
                $(".commentAlert ").html(html);
            } else if ($('#comment').val().length == 0) { // if the comment is  empty
                var html = '<div class="alert alert-danger">\
                                                                <ul>\
                                                                    <li>الرجاء كتابة تعليق</li>\
                                                                </ul>\
                                                            </div>';
                $(".commentAlert ").html(html);
            } else { // if the user is authenticated and the comment is not empty
                $(".commentAlert ").html(''); // delete the alerts if found
                event.preventDefault();
                videoId = $("#videoId").val();
                comment = $("#comment").val();

                $.ajax({
                    method: 'POST',
                    url: urlComment,
                    data: {
                        comment: comment,
                        videoId: videoId,
                        _token: token
                    },
                    success: function(data) {
                        $("#comment").val(''); // empty the comment input

                        destroyUrl = "{{ route('comment.destroy', 'des_id') }}";
                        destroy = destroyUrl.replace('des_id', data.commentId);

                        editUrl = "{{ route('comment.edit', 'id') }}";
                        url = editUrl.replace('id', data.commentId);

                        var html = '  <div class="card mt-5 mb-3">\
                                                        <div class="card-body">\
                                                            <div class="row">\
                                                                <div class="col-2">\
                                                                    <img src="' + data.userImage + '" width="150px" class="rounded-full"/>\
                                                                </div>\
                                                                <div class="col-10">\
                                                                    <form method="GET" action="' + destroy + '">\
                                                                        @csrf\
                                                                        @method('DELETE')\
                                                                        <button type="submit" class="float-left"><i class="far fa-trash-alt text-danger fa-lg"></i></button>\
                                                                    </form>\
                                                                    <form method="GET" action="' + url + '">\
                                                                        @csrf\
                                                                        @method('PATCH')\
                                                                        <button type="submit" class="float-left"><i class="far fa-edit text-success fa-lg ml-3"></i></button>\
                                                                    </form>\
                                                                    <p class="mt-3 mb-2"><strong>' + data.userName + '</strong></p>\
                                                                    <i class="far fa-clock"></i> <span class="comment_date text-secondary">' + data.commentDate + '</span>\
                                                                    <p class="mt-3" >' + comment + '</p>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>';
                        $(".commentBody").prepend(html);
                    }
                })
            }
        });
    </script>
@endSection
