@extends('dashboard.layout.app')

@section('content')
    @if(session('library-created'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('library-created') }}
            </div>
        </div>
    @endif
    @if(session('library-updated'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('library-updated') }}
            </div>
        </div>
    @endif
    @if(session('library-deleted'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('library-deleted') }}
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="create-plan-container">
                    <a href="{{ route('dashboard.library.create') }}">
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
                    <th>{{ __('dashboard.extension') }}</th>
                    <th>{{ __('dashboard.type') }}</th>
                    <th>{{ __('dashboard.section') }}</th>
                    <th>{{ __('dashboard.options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libraryFiles as $file)
                    <tr>
                        <td>{{ $file->file_name }}</td>
                        <td>{{ $file->file_extension }}</td>
                        <td>{{ ucwords(strtolower(\App\Enums\LibraryFileType::getName($file->file_type))) }}</td>
                        <td>{{ $file->section != null ? $file->section->name : '---' }}</td>
                        <td>
                            <div class="actions">
                                <div class="edit">
                                    <a href="{{ route('dashboard.library.edit', $file->id) }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-pen"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="delete">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModel{{ $file->id }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-x"></use>
                                        </svg>
                                    </button>

                                    <div class="modal fade" id="deleteModel{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModelLabel">{{ __('dashboard.are_you_sure') }}</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                    <form action="{{ route('dashboard.library.delete', $file->id) }}" method="POST">
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
        {{ $libraryFiles->links() }}

    </div>
@endsection
