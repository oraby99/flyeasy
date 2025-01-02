@extends('dashboard.layout.app')

@section('content')
    @if(session('library-sections-created'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('library-sections-created') }}
            </div>
        </div>
    @endif
    @if(session('library-sections-updated'))
        <div class="container">
            <div class="alert alert-success custom-alert" role="alert">
                {{ session('library-sections-updated') }}
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="create-plan-container">
                    <a href="{{ route('dashboard.library.sections.create') }}">
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
                    <th>{{ __('dashboard.options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($librarySections as $section)
                    <tr>
                        <td>{{ $section->name }}</td>
                        <td>
                            <div class="actions">
                                <div class="edit">
                                    <a href="{{ route('dashboard.library.sections.edit', $section->id) }}">
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
        {{ $librarySections->links() }}

    </div>
@endsection
