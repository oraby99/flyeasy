<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login - Fly Easy</title>

    <link rel="icon" href="{{ asset('portal/images/final logo 1.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}" />
</head>
<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <form action="{{ route('dashboard.auth.login-process') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card-group d-block d-md-flex row">
                            <div class="card col-md-7 p-4 mb-0">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif
                                    <h1>Login</h1>
                                    <p class="text-medium-emphasis">Sign In to your account</p>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-user"></use>
                                            </svg>
                                        </span>
                                        <input
                                            value="{{ old('email') }}"
                                            class="form-control"
                                            placeholder="Email"
                                            name="email"
                                            type="text"
                                        />
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">
                                            <svg class="icon">
                                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-lock-locked"></use>
                                            </svg>
                                        </span>
                                        <input class="form-control" name="password" type="password" placeholder="Password" />
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('admin/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
</body>
</html>
