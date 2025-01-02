@extends('dashboard.layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-4" style="--cui-card-cap-bg: #0b1b3b;background: transparent">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <div class="icon-3xl text-white my-4" style="font-size: 30px">
                        {{ __('dashboard.users.title') }}
                    </div>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-1" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countUsers }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-4" style="--cui-card-cap-bg: #2f9d7a;background: transparent">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <div class="icon-3xl text-white my-4" style="font-size: 30px">
                        {{ __('dashboard.channels.teams') }}
                    </div>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-2" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countTeams }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-4" style="--cui-card-cap-bg: #0b1b3b;background: transparent">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <div class="icon-3xl text-white my-4" style="font-size: 30px">
                        {{ __('dashboard.channels.communities') }}
                    </div>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-3" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countCommunities }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-4" style="--cui-card-cap-bg: #17a2b8;background: transparent">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <div class="icon-3xl text-white my-4" style="font-size: 30px">
                        {{ __('dashboard.channels.sub-communities') }}
                    </div>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-3" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countSubCommunities }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
