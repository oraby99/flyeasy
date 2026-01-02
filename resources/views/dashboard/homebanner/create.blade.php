@extends('dashboard.layout.app')

@section('content')
    <div class="custom-form">
        <div class="form">
            <form action="{{ route('dashboard.HomeBanners.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('dashboard.title') }}</label>
                            <input class="form-control form-input" type="text" name="title" value="{{ old('title') }}" placeholder="{{ __('dashboard.title') }}" />
                            @error('title')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('dashboard.image') }}</label>
                            <input class="form-control form-input" type="file" name="image" />
                            @error('image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="form-control form-submit" type="submit">{{ __('dashboard.store') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
