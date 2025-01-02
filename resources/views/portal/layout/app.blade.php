<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('portal.title') }}</title>

    <link rel="icon" href="{{ asset('portal/images/final logo 1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{ asset('portal/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/css/main.css') }}">
</head>
<body>

    @yield('content')

    <script src="{{ asset('portal/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('portal/js/all.min.js') }}"></script>
    <script src="{{ asset('portal/js/main.js') }}"></script>

</body>
</html>
