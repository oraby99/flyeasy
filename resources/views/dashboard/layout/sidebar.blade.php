
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <div class="sidebar-brand-full">
            <img class="logo" src="{{ asset('admin/images/logo.png') }}" alt="Fly Easy Logo">
        </div>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'home')) active @endif" href="{{ route('dashboard.home.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-speedometer"></use>
                </svg>
                {{ __('dashboard.teams-page') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'users')) active @endif" href="{{ route('dashboard.users.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-group"></use>
                </svg>
                {{ __('dashboard.users.title') }}
            </a>
        </li>
        <li class="nav-group
            @if(
                request()->is('dashboard/teams-channels/*')
                ||
                request()->is('dashboard/communities-channels/*')
                ||
                request()->is('dashboard/communities-communities-channels/*')
            )
                show
            @endif
        ">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-puzzle"></use>
                </svg>
                {{ __('dashboard.channels.title') }}
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'teams-channels')) active @endif" href="{{ route('dashboard.teams.index') }}">
                        <span class="nav-icon"></span>
                        {{ __('dashboard.channels.teams') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('dashboard/communities-channels/*')) active @endif" href="{{ route('dashboard.communities.index') }}">
                        <span class="nav-icon"></span>
                        {{ __('dashboard.channels.communities') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('dashboard/communities-communities-channels/*')) active @endif" href="{{ route('dashboard.sub-communities.index') }}">
                        <span class="nav-icon"></span>
                        {{ __('dashboard.channels.sub-communities') }}
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'plans')) active @endif" href="{{ route('dashboard.plans.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-short-text"></use>
                </svg>
                {{ __('dashboard.plans.title') }}
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'subscriptions')) active @endif" href="{{ route('dashboard.subscriptions.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-short-text"></use>
                </svg>
                {{ __('dashboard.subscriptions.title') }}
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'transactions')) active @endif" href="{{ route('dashboard.transactions.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-short-text"></use>
                </svg>
                {{ __('dashboard.transactions.title') }}
            </a>
        </li>
        <li class="nav-group @if(request()->is('dashboard/library/*')) show @endif">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-puzzle"></use>
                </svg>
                {{ __('dashboard.library.title') }}
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('dashboard/library/sections')) active @endif" href="{{ route('dashboard.library.sections.index') }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-file"></use>
                        </svg>
                        {{ __('dashboard.library.sections.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('dashboard/library')) active @endif" href="{{ route('dashboard.library.index') }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-file"></use>
                        </svg>
                        {{ __('dashboard.library.files.title') }}
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Str::contains(URL::current(), 'settings')) active @endif" href="{{ route('dashboard.settings.edit') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-settings"></use>
                </svg>
                {{ __('dashboard.settings.title') }}
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link @if(request()->is('dashboard/banners')) active @endif" href="{{ route('dashboard.banners.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-image"></use>
                </svg>
                {{ __('dashboard.banners.title') }}
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link @if(request()->is('dashboard/HomeBanners')) active @endif" href="{{ route('dashboard.HomeBanners.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-image"></use>
                </svg>
                {{ __('dashboard.HomeBanners.title') }}
            </a>
        </li>
        
    </ul>
</div>
