@extends('dashboard.layout.app')

@section('content')
    @if(session('plan-created'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('plan-created') }}
            </div>
        </div>
    @endif
    @if(session('plan-updated'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('plan-updated') }}
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="create-plan-container">
                    <a href="{{ route('dashboard.plans.create') }}">
                        {{ __('dashboard.create') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive table-custom">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('dashboard.name') }}</th>
                    <th>{{ __('dashboard.type') }}</th>
                    <th>{{ __('dashboard.count') }}</th>
                    <th>{{ __('dashboard.price') }}</th>
                    <th>{{ __('dashboard.num-of-months') }}</th>
                    <th>{{ __('dashboard.num-of-sections') }}</th>
                    <th>{{ __('dashboard.options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td>{{ ucwords(strtolower(\App\Enums\PlanTypeEnum::getName($plan->type))) }}</td>
                        <td>{{ $plan->count ?? '---' }}</td>
                        <td>{{ $plan->price }}</td>
                        <td>{{ $plan->num_of_months ?? '---' }}</td>
                        <td>{{ $plan->library_sections_count ?? '---' }}</td>
                        <td>
                            <div class="actions">
                                <div class="edit">
                                    <a href="{{ route('dashboard.plans.edit', $plan->id) }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-pen"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="delete">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModel{{ $plan->id }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-x"></use>
                                        </svg>
                                    </button>

                                    <div class="modal fade" id="deleteModel{{ $plan->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModelLabel">{{ __('dashboard.are_you_sure') }}</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                    <form action="{{ route('dashboard.plans.delete', $plan->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">{{ __('dashboard.delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      {{ $plans->links() }}

    </div>
@endsection
