@extends('dashboard.layout.app')

@section('content')
    <div class="custom-form">
        <div class="form">
            <form action="{{ route('dashboard.plans.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input
                                    placeholder="{{ __('dashboard.plans.edit.name-placeholder') }}"
                                    class="form-control form-input"
                                    value="{{ old('name') }}"
                                    type="text"
                                    name="name"
                                />
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <select class="form-control form-input" name="type" id="planType">
                                    @foreach(\App\Enums\PlanTypeEnum::getNamesAndValues() as $name => $value)
                                        <option value="{{ $value }}" @if(old('type') == $value) selected @endif>{{ ucwords(strtolower($name)) }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 plan-count d-none">
                        <div class="form-group">
                            <label>
                                <input
                                    placeholder="{{ __('dashboard.plans.edit.count-placeholder') }}"
                                    class="form-control form-input d-none"
                                    value="{{ old('count') }}"
                                    id="planCount"
                                    type="number"
                                    name="count"
                                />
                                @error('count')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 library-section d-none">
                        <div class="form-group">
                            <label>
                                <select class="form-control form-input d-none" name="sections[]" id="librarySection" multiple>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" @if(old('sections') != null && count(old('sections')) > 0 && in_array($section->id, old('sections'))) selected @endif>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('sections')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input
                                    placeholder="{{ __('dashboard.plans.edit.price-placeholder') }}"
                                    class="form-control form-input"
                                    value="{{ old('price') }}"
                                    type="number"
                                    name="price"
                                />
                                @error('price')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 num-of-months d-none">
                        <div class="form-group">
                            <label>
                                <input
                                    placeholder="{{ __('dashboard.plans.edit.num-of-months-placeholder') }}"
                                    class="form-control form-input d-none"
                                    value="{{ old('num_of_months') }}"
                                    name="num_of_months"
                                    id="numOfMonths"
                                    type="number"
                                />
                                @error('num_of_months')
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#planType').on('change', function () {
                if($(this).val() == '{{ \App\Enums\PlanTypeEnum::LIBRARY }}') {
                    $('#librarySection').removeClass('d-none');
                    $('.library-section').removeClass('d-none');
                    $('#numOfMonths').removeClass('d-none');
                    $('.num-of-months').removeClass('d-none');
                    $('#planCount').addClass('d-none');
                    $('.plan-count').addClass('d-none');
                } else {
                    $('#librarySection').addClass('d-none');
                    $('.library-section').addClass('d-none');
                    $('#numOfMonths').addClass('d-none');
                    $('.num-of-months').addClass('d-none');
                    $('#planCount').removeClass('d-none');
                    $('.plan-count').removeClass('d-none');
                }
            })

            if($('#planType').val() == '{{ \App\Enums\PlanTypeEnum::LIBRARY }}') {
                $('#librarySection').removeClass('d-none');
                $('.library-section').removeClass('d-none');
                $('#numOfMonths').removeClass('d-none');
                $('.num-of-months').removeClass('d-none');
                $('#planCount').addClass('d-none');
                $('.plan-count').addClass('d-none');
            } else {
                $('#librarySection').addClass('d-none');
                $('.library-section').addClass('d-none');
                $('#numOfMonths').addClass('d-none');
                $('.num-of-months').addClass('d-none');
                $('#planCount').removeClass('d-none');
                $('.plan-count').removeClass('d-none');
            }
        })
    </script>
@endpush
