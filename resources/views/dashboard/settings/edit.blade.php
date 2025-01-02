@extends('dashboard.layout.app')

@section('content')
    @if(session('settings-updated'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('settings-updated') }}
            </div>
        </div>
    @endif
    <div class="custom-form">
        <div class="form">
            <form action="{{ route('dashboard.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                {{ __('dashboard.settings.free-teams') }}
                                <input
                                    value="{{ $settings->where('key', 'free_teams_count')->value('value') }}"
                                    placeholder="{{ __('dashboard.settings.free-teams-placeholder') }}"
                                    class="form-control form-input"
                                    name="free_teams_count"
                                    type="number"
                                />
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                {{ __('dashboard.settings.free-communities') }}
                                <input
                                    value="{{ $settings->where('key', 'free_communities_count')->value('value') }}"
                                    placeholder="{{ __('dashboard.settings.free-communities-placeholder') }}"
                                    class="form-control form-input"
                                    name="free_communities_count"
                                    type="number"
                                />
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                {{ __('dashboard.settings.free-sub-communities') }}
                                <input
                                    value="{{ $settings->where('key', 'free_sub_communities_count')->value('value') }}"
                                    placeholder="{{ __('dashboard.settings.free-sub-communities-placeholder') }}"
                                    name="free_sub_communities_count"
                                    class="form-control form-input"
                                    type="number"
                                />
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                {{ __('dashboard.settings.free-members') }}
                                <input
                                    value="{{ $settings->where('key', 'free_members_count')->value('value') }}"
                                    placeholder="{{ __('dashboard.settings.free-members-placeholder') }}"
                                    class="form-control form-input"
                                    name="free_members_count"
                                    type="number"
                                />
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
