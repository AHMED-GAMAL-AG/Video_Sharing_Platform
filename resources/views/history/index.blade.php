@extends('layouts.main')

@section('content')
    <div class="mx-4">
        @if ($videos_in_history->count() > 0)
            <div class="row justify-content-center">
                <form class="form-inline col-md-6 justify-content-center" method="POST" action="{{route('history.clear')}}" onsubmit="return confirm('{{ __('هل أنت متأكد أنك تريد حذف السجل بشكلٍ كامل؟') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mb-4">{{ __('تفريغ السجل') }}</button>
                </form>
            </div>
            <hr>
        @endif
        <br>

        <p class="my-4">{{ $title }}</p>
        <div class="row">
            @forelse($videos_in_history as $video)
                @if ($video->processed)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                        <div class="card">
                            <div class="card-icons">
                                @php
                                    $hours_add_zero = sprintf('%02d', $video->hours);
                                @endphp
                                @php
                                    $minutes_add_zero = sprintf('%02d', $video->minutes);
                                @endphp
                                @php
                                    $seconds_add_zero = sprintf('%02d', $video->seconds);
                                @endphp
                                <a href="/videos/{{ $video->id }}">
                                    <img src="{{ Storage::url($video->image_path) }}" class="card-img-top" alt="...">
                                    <time>{{ $video->hours > 0 ? $hours_add_zero . ':' : '' }}{{ $minutes_add_zero }}:{{ $seconds_add_zero }}</time>
                                    <i class="fas fa-play fa-2x"></i>
                                </a>
                            </div>
                            <a href="/videos/{{ $video->id }}">
                                <div class="card-body p-0">
                                    <p class="card-title mr-1">{{ Str::limit($video->title, 60) }}</p>
                                </div>
                            </a>
                            <div class="card-footer">
                                <small class="text-muted">
                                    @foreach ($video->views as $view)
                                        <span class="d-block"><i class="fas fa-eye"></i> {{ $view->views_number }} {{ __('مشاهدة') }}</span>
                                    @endforeach

                                    <i class="fas fa-clock"></i> <span>{{ $video->pivot->created_at->diffForHumans() }}</span>

                                    @auth
                                        @if ($video->user_id == auth()->user()->id || auth()->user()->administration_level > 0)
                                            <form method="POST" action="{{route('history.destroy' , $video->pivot->id)}}" onsubmit="return confirm('{{ __('هل أنت متأكد أنك تريد حذف مقطع المقطع هذا؟') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="float-left"><i class="far fa-trash-alt text-danger fa-lg"></i></button>
                                            </form>
                                        @endif
                                    @endauth
                                </small>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="mx-auto col-8">
                    <div class="alert alert-primary text-center" role="alert">
                        {{ __('لا يوجد فيديوهات') }}
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
