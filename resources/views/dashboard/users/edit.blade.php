@extends('dashboard.layout.app')

@section('content')
    <div class="custom-form">
        <div class="form">
            <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <select class="form-control form-input" name="status">
                                    @foreach(\App\Enums\ActivationStatus::getNamesAndValues() as $name => $value)
                                        <option value="{{ $value }}" @if($user->status == $value) selected @endif>
                                            {{ ucwords(strtolower($name)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input
                                    placeholder="{{ __('dashboard.users.edit.discount-placeholder') }}"
                                    class="form-control form-input"
                                    value="{{ $user->discount }}"
                                    name="discount"
                                    type="number"
                                />
                                @error('discount')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="form-control form-submit" type="submit">{{ __('dashboard.update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
