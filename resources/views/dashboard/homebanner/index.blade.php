@extends('dashboard.layout.app')

@section('content')
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="create-plan-container">
                    <a href="{{ route('dashboard.HomeBanners.create') }}">
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
                    <th>{{ __('dashboard.title') }}</th>
                    <th>{{ __('dashboard.image') }}</th>
                    <th>{{ __('dashboard.options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->title }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}"
                                style="width: 100px;">
                        </td>
                        <td>
                            <div class="actions">
                                <div class="edit">
                                    <a href="{{ route('dashboard.HomeBanners.edit', $banner->id) }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-pen"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="delete">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#deleteModel{{ $banner->id }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-x"></use>
                                        </svg>
                                    </button>

                                    <div class="modal fade" id="deleteModel{{ $banner->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModelLabel">
                                                        {{ __('dashboard.are_you_sure') }}</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                    <form action="{{ route('dashboard.HomeBanners.delete', $banner->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('dashboard.delete') }}</button>
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
    </div>
@endsection