@extends('dashboard.layout.app')

@section('content')
    @if(session('user-updated'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('user-updated') }}
            </div>
        </div>
    @endif
    <div class="table-responsive table-custom">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('dashboard.name') }}</th>
                    <th>{{ __('dashboard.email') }}</th>
                    <th>{{ __('dashboard.phone') }}</th>
                    <th>{{ __('dashboard.discount') }}</th>
                    <th>{{ __('dashboard.work_id') }}</th>
                    <th>{{ __('dashboard.company') }}</th>
                    <th>{{ __('dashboard.status') }}</th>
                    <th>{{ __('dashboard.is_verified') }}</th>
                    <th>{{ __('dashboard.options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->country_code }}{{ $user->phone }}</td>
                        <td>{{ $user->discount . '%' }}</td>
                        <td>{{ $user->work_id }}</td>
                        <td>{{ $user->company }}</td>
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
                        <td>
                            <div class="actions">
                                <div class="show">
                                    <a href="{{ route('dashboard.users.show', $user->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                                <div class="edit">
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-pen"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
