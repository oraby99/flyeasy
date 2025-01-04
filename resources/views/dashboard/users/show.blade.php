@extends('dashboard.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="show-users-data">
            <ul class="nav nav-tabs" id="mainChannelInfo" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        aria-controls="basic-info"
                        data-target="#basic-info"
                        class="nav-link active"
                        aria-selected="false"
                        id="basic-info-tab"
                        data-toggle="tab"
                        type="button"
                        role="tab"
                    >
                        {{ __('dashboard.basic-info') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        aria-controls="teams"
                        aria-selected="false"
                        data-target="#teams"
                        data-toggle="tab"
                        class="nav-link"
                        id="teams-tab"
                        type="button"
                        role="tab"
                    >
                        {{ __('dashboard.channels.teams') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        aria-controls="communities"
                        data-target="#communities"
                        aria-selected="false"
                        id="communities-tab"
                        data-toggle="tab"
                        class="nav-link"
                        type="button"
                        role="tab"
                    >
                        {{ __('dashboard.channels.communities') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        aria-controls="sub-communities"
                        data-target="#sub-communities"
                        id="sub-communities-tab"
                        aria-selected="false"
                        data-toggle="tab"
                        class="nav-link"
                        type="button"
                        role="tab"
                    >
                        {{ __('dashboard.channels.sub-communities') }}
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="mainChannelInfoContent">
                <div
                    class="tab-pane fade mt-3 active show"
                    aria-labelledby="basic-info-tab"
                    id="basic-info"
                    role="tabpanel"
                >
                    <div class="table-responsive table-custom">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">{{ __('dashboard.profile-image') }}</th>
                                    <td>
                                        <img
                                            src="
                                                @if($user->profile_image != null)
                                                    {{ url('storage/app/' . $user->profile_image) }}
                                                @else
                                                    {{ asset('admin/images/profile.png') }}
                                                @endif
                                            "
                                            alt="User Profile Image"
                                            class="profile-image"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('dashboard.name') }}</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('dashboard.email') }}</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('dashboard.phone') }}</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <td>
                                        @if($user->status == \App\Enums\ActivationStatus::ACTIVE)
                                            <svg class="icon me-2 correct-icon">
                                                <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-check-alt"></use>
                                            </svg>
                                        @else
                                            <svg class="icon me-2 un-correct-icon">
                                                <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-x"></use>
                                            </svg>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('dashboard.is_verified') }}</th>
                                    <td>
                                        @if($user->email_verified_at != null)
                                            <svg class="icon me-2 correct-icon">
                                                <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-check-alt"></use>
                                            </svg>
                                        @else
                                            <svg class="icon me-2 un-correct-icon">
                                                <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-x"></use>
                                            </svg>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    aria-labelledby="teams-tab"
                    class="tab-pane fade mt-3"
                    role="tabpanel"
                    id="teams"
                >
                    <div class="channels d-flex">
                        @foreach($user->teams as $team)
                            <div class="channel">
                                <p class="channel-name">
                                    <a href="{{ route('dashboard.teams.show', $team->id) }}">
                                        {{ $team->name }}
                                    </a>
                                </p>
                                <p class="user-group">
                                    {{ ucwords(strtolower(\App\Enums\ChannelGroup::getName($team->pivot->member_group))) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div
                    aria-labelledby="communities-tab"
                    class="tab-pane fade mt-3"
                    id="communities"
                    role="tabpanel"
                >
                    <div class="channels d-flex">
                        @foreach($user->communities as $community)
                            <div class="channel">
                                <p class="channel-name">
                                    <a href="{{ route('dashboard.communities.show', $community->id) }}">
                                        {{ $community->name }}
                                    </a>
                                </p>
                                <p class="user-group">
                                    {{ ucwords(strtolower(\App\Enums\ChannelGroup::getName($community->pivot->member_group))) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div
                    aria-labelledby="sub-communities-tab"
                    class="tab-pane fade mt-3"
                    id="sub-communities"
                    role="tabpanel"
                >
                    <div class="channels d-flex">
                        @foreach($user->subCommunities as $subCommunity)
                            <div class="channel">
                                <p class="channel-name">
                                    <a href="{{ route('dashboard.sub-communities.show', $subCommunity->id) }}">
                                        {{ $subCommunity->name }}
                                    </a>
                                </p>
                                <p class="user-group">
                                    {{ ucwords(strtolower(\App\Enums\ChannelGroup::getName($subCommunity->pivot->member_group))) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
