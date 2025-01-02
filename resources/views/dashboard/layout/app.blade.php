<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <title>{{ __('dashboard.title') }}</title>

    <link rel="icon" href="{{ asset('admin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/coreui-chartjs.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}" />
</head>
<body>

    @include('dashboard.layout.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100">

        @include('dashboard.layout.header')

        <div class="container-fluid mb-3">

            @yield('content')

        </div>

    </div>

    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/all.js') }}"></script>
    <script src="{{ asset('admin/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/js/chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('admin/js/coreui-utils.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('admin/js/mymain.js') }}"></script>

    @stack('scripts')
</body>
</html>
