@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card mb-2 col-md-8">
                <div class="card-header text-center">
                    {{ __('رفع فيديو جديد') }}
                </div>

                @if (auth()->user()->block)
                    <div class="alert alert-danger mt-1" role="alert">
                        {{ __('للأسف لا تستطيع رفع مقاطع فيديو، يرجى التواصل مع الإدارة لمعرفة السبب') }}
                    </div>
                @else
                    <div class="card-body">
                        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">{{ __('عنوان المقطع') }}</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group file-area">
                                <label for="image">{{ __('صورة الغلاف') }}</label>
                                <input type="file" id="image" accept="image/*" onchange="readCoverImage(this);" name="image" class="form-control @error('image') is-invalid @enderror">
                                <div class="input-title">{{ __('اسحب الصورة إلى هنا أو انقر للاختيار يدويًا') }}</div>

                                @error('image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <img id="cover-image-thumb" class="col-2" width="100" height="100">
                                <span class="input-name col-6"></span>
                            </div>

                            <div class="form-group file-area">
                                <label for="video">{{ __('مقطع المقطع') }}</label>
                                <input type="file" id="video" accept="video/*" onchange="readVideo(this);" name="video" class="form-control @error('video') is-invalid @enderror">
                                <div class="input-title">{{ __('اسحب مقطع المقطع إلى هنا أو انقر للاختيار يدويًا') }}</div>

                                @error('video')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <span class="video-name mb-4"></span>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <button type="" class="btn btn-secondary">{{ __('رفع المقطع') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover-image-thumb').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $(".input-name").html(input.files[0].name);
            }
        }

        function readVideo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.readAsDataURL(input.files[0]);
                $(".video-name").html('\
                                            <div class="alert alert-primary">\
                                                تم اختيار مقطع المقطع بنجاح ' + input.files[0].name + '\
                                            </div>');
            }
        }
    </script>
@endsection
