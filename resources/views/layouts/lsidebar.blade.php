{{-- Tabler Vertical Sidebar --}}
<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">

        {{-- Mobile toggler --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Logo --}}
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ homeRoute() }}">
                <img src="{{ asset('images/logo@2x.png') }}" height="36" alt="{{ config('app.name') }}"
                    class="navbar-brand-image" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <span style="display:none; color:white; font-size:1.1rem; font-weight:600;">
                    {{ config('app.name') }}
                </span>
            </a>
        </h1>

        {{-- Mobile user dropdown --}}
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                    <span class="avatar avatar-sm bg-blue-lt text-white fw-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="dropdown-header">
                        <div class="fw-medium">{{ Auth::user()->name }}</div>
                        <div class="small text-secondary">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/logout') }}" class="dropdown-item text-danger">
                        <i class="ti ti-logout me-2"></i>Esci
                    </a>
                </div>
            </div>
        </div>

        {{-- Sidebar menu --}}
        <div class="collapse navbar-collapse" id="sidebar-menu">

            {{-- User info (desktop sidebar) --}}
            <div class="d-none d-lg-block mt-3 mb-2 px-2">
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm bg-blue me-2 fw-bold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <div>
                        <div class="text-white lh-1 small fw-medium">{{ Auth::user()->name }}</div>
                        <div class="text-white-50 lh-1 mt-1" style="font-size:0.7rem;">
                            {{ Auth::user()->getRoleName() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block border-top border-white-10 my-2"></div>

            <ul class="navbar-nav pt-lg-2">

                {{-- Admin menu --}}
                @role(['admin'])

                    {{-- Home --}}
                    <li class="nav-item">
                        <a class="nav-link {{ isSectionActive(['home'], 1) ? 'active' : '' }}"
                            href="{{ route('admin.home') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>

                    {{-- Divider --}}
                    <li class="nav-item mt-2">
                        <div class="nav-link disabled text-white-50 text-uppercase small fw-bold" style="font-size:0.65rem; letter-spacing:.05em;">
                            <span class="nav-link-title">Sistema</span>
                        </div>
                    </li>

                    {{-- Utenti --}}
                    <li class="nav-item">
                        <a class="nav-link {{ isSectionActive(['user'], 1) ? 'active' : '' }}"
                            href="{{ route('admin.user.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="nav-link-title">Utenti</span>
                        </a>
                    </li>

                    {{-- Log --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/log-viewer') }}" target="_blank">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-file-text"></i>
                            </span>
                            <span class="nav-link-title">Log <i class="ti ti-external-link ms-1" style="font-size:.7rem;"></i></span>
                        </a>
                    </li>

                @endrole

                {{-- User menu --}}
                @role(['user'])

                    <li class="nav-item">
                        <a class="nav-link {{ isSectionActive(['home'], 1) ? 'active' : '' }}"
                            href="{{ route('user.home') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="nav-link-title">Home</span>
                        </a>
                    </li>

                @endrole

            </ul>

            {{-- Sidebar footer --}}
            <div class="mt-auto pt-3 border-top border-white-10">
                <x-admin.footer />
            </div>

        </div>
    </div>
</aside>
