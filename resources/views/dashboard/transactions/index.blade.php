@extends('dashboard.layout.app')

@section('content')
    <div class="table-responsive table-custom">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('dashboard.user') }}</th>
                    <th>{{ __('dashboard.plan-name') }}</th>
                    <th>{{ __('dashboard.price') }}</th>
                    <th>{{ __('dashboard.currency') }}</th>
                    {{-- <th>{{ __('dashboard.payment-method') }}</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            <a href="{{ route('dashboard.users.show', $transaction->user->id) }}">
                                {{ $transaction->user->name }}
                            </a>
                        </td>
                        <td>
                            {{ $transaction->plan->name }}
                        </td>
                        <td>
                            {{ $transaction->amount }}
                        </td>
                        <td>
                            {{ $transaction->currency }}
                        </td>
                        {{-- <td>
                            {{ ucwords(strtolower(\App\Enums\PaymentMethod::getName($transaction->payment_method))) }}
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>        {{ $transactions->links() }}

    </div>
@endsection
