@extends('dashboard.layout.app')

@section('content')
    <div class="custom-form">
        <div class="form">
            <form action="{{ route('dashboard.library.sections.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input
                                    placeholder="{{ __('dashboard.library.sections.create.name-placeholder') }}"
                                    class="form-control form-input"
                                    type="text"
                                    name="name"
                                />
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
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
