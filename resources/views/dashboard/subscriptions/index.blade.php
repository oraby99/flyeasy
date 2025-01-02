@extends('dashboard.layout.app')

@section('content')
    <div class="table-responsive table-custom">
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th>{{ __('dashboard.user') }}</th>
                    <th>{{ __('dashboard.plan-name') }}</th>
                    <th>{{ __('dashboard.price') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>
                            <a href="{{ route('dashboard.users.show', $subscription->user->id) }}">
                                {{ $subscription->user->name }}
                            </a>
                        </td>
                        <td>
                            {{ $subscription->plan->name }}
                        </td>
                        <td>
                            {{ $subscription->plan->price }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
