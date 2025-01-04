@extends('dashboard.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="show-communities">
            <ul class="nav nav-tabs" id="communitiesInfo" role="tablist">
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
                        aria-controls="members"
                        data-target="#members"
                        aria-selected="false"
                        data-toggle="tab"
                        id="members-tab"
                        class="nav-link"
                        type="button"
                        role="tab"
                    >
                        {{ __('dashboard.channels.members') }}
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
            <div class="tab-content" id="communitiesInfoContent">
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
                                    <th scope="row">{{ __('dashboard.logo') }}</th>
                                    <td>
                                        <img
                                            src="
                                                @if($channel->logo != null)
                                                    {{ url('storage/app/' . $channel->logo) }}
                                                @else
                                                    {{ asset('admin/images/channel.jpeg') }}
                                                @endif
                                            "
                                            alt="Channel logo"
                                            class="channel-logo"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('dashboard.name') }}</th>
                                    <td>{{ $channel->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('dashboard.members_count') }}</th>
                                    <td>{{ $channel->users->count() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    aria-labelledby="members-tab"
                    class="tab-pane fade mt-3"
                    role="tabpanel"
                    id="members"
                >
                    <div class="members d-flex">
                        @foreach($channel->users as $user)
                            <div class="member">
                                <p class="name">
                                    <a href="{{ route('dashboard.users.show', $user->id) }}">
                                        {{ $user->name }}
                                    </a>
                                </p>
                                <p class="group">
                                    {{ ucwords(strtolower(\App\Enums\ChannelGroup::getName($user->pivot->member_group))) }}
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
                    <div class="sub-sub-channels d-flex">
                        @foreach($channel->subCommunities as $subCommunity)
                            <div class="channel">
                                <a href="{{ route('dashboard.sub-communities.show', $subCommunity->id) }}">
                                    {{ $subCommunity->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
