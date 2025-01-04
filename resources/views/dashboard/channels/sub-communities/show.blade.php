@extends('dashboard.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="show-sub-communities">
            <ul class="nav nav-tabs" id="subCommunityInfo" role="tablist">
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
            </ul>
            <div class="tab-content" id="subCommunityInfoContent">
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
                                            class="channel-logo"
                                            alt="Channel logo"
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
            </div>
        </div>
    </div>
@endsection
