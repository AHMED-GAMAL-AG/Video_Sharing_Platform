@extends('layouts.main')

@section('content')
    <div class="row latest-download">
        <div class="container">
            <div class="row justify-content-center">
                <form class="form-inline col-md-6 justify-content-center" action="{{ route('channels.search') }}" method="GET">
                    <input type="text" class="form-control mx-sm-3 mb-3 form-control @error('term') invalid-feedback  is-invalid @enderror" name="term" placeholder="@error('term') {{ $message }} @enderror" >
                    <button type="" class="btn btn-secondary mb-3">{{__('ابحث')}}</button>
                </form>
            </div>
            <hr>
            <br>
            <p class="my-4">{{ $title }}</p>
            <div class="row">
                @forelse($channels as $channel)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="m-4">
                            <img class="rounded-full mx-auto" width="120px" src="{{ $channel->profile_photo_url }}">

                            <div class="card-body p-0">
                                <p class="text-center mt-4">{{ $channel->name }}</p>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('channel.videos', $channel->id) }}" class="btn btn-secondary btn-lg mt-1">{{__('تصفح القناة')}}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="mx-auto">
                        <p>{{__('لا يوجد قنوات')}}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
