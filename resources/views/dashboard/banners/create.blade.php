@extends('dashboard.layout.app')

@section('content')
    <div class="custom-form">
        <div class="form">
            <form action="{{ route('dashboard.library.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input class="form-control form-input" type="file" name="file" />
                                @error('file')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <select class="form-control form-input" name="type">
                                    @foreach(\App\Enums\LibraryFileType::getNamesAndValues() as $name => $value)
                                        <option value="{{ $value }}" @if(old('type') == $value) selected @endif>{{ ucwords(strtolower($name)) }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <select class="form-control form-input" name="section_id">
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
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
