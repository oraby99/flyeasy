@extends('dashboard.layout.app')

@section('content')
    @if(session('channel-updated'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('channel-updated') }}
            </div>
        </div>
    @endif
    <div class="table-responsive table-custom">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('dashboard.name') }}</th>
                    <th>{{ __('dashboard.members_count') }}</th>
                    <th>{{ __('dashboard.options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($channels as $channel)
                    <tr>
                        <td>{{ $channel->name }}</td>
                        <td>{{ $channel->members_count }}</td>
                        <td>
                            <div class="actions">
                                <div class="show">
                                    <a href="{{ route('dashboard.teams.show', $channel->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $channels->links() }}

    </div>
@endsection
