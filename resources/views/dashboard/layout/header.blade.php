
<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-menu"></use>
            </svg>
        </button>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ asset('admin/images/profile.png') }}" alt="user@email.com" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">
                            {{ __('dashboard.header.settings') }}
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('dashboard.auth.logout') }}">
                        <svg class="icon me-2 logout-icon">
                            <use xlink:href="{{ asset('admin/images/free.svg') }}#cil-account-logout"></use>
                        </svg>
                        {{ __('dashboard.header.logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>
