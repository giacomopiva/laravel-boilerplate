{{-- Tabler Top Header --}}
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        {{-- Breadcrumb / page title area (filled via @section if needed) --}}
        <div class="me-auto"></div>

        <div class="navbar-nav flex-row order-md-last">

            {{-- Toggle modalità chiara/scura --}}
            <div class="nav-item me-2 d-flex align-items-center">
                <a href="#" class="nav-link px-0" id="darkmode-toggle" title="Cambia modalità colore">
                    <i class="ti ti-moon fs-4" id="darkmode-icon-moon"></i>
                    <i class="ti ti-sun fs-4 d-none" id="darkmode-icon-sun"></i>
                </a>
            </div>

            {{-- User dropdown --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm bg-blue-lt text-blue fw-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div class="fw-medium lh-1">{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-secondary">{{ Auth::user()->getRoleName() }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="dropdown-header">
                        <div class="small text-secondary">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/logout') }}" class="dropdown-item text-danger">
                        <i class="ti ti-logout me-2 icon-sm"></i>Esci
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>

<script>
    // Toggle modalità chiara/scura: persiste in localStorage (chiave 'tabler-theme',
    // la stessa letta dallo script anti-flash in layouts/admin/app.blade.php).
    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.getElementById('darkmode-toggle');
        var moonIcon = document.getElementById('darkmode-icon-moon');
        var sunIcon = document.getElementById('darkmode-icon-sun');
        var html = document.documentElement;

        function syncIcon() {
            var isDark = html.getAttribute('data-bs-theme') === 'dark';
            moonIcon.classList.toggle('d-none', isDark);
            sunIcon.classList.toggle('d-none', !isDark);
        }
        syncIcon();

        toggle?.addEventListener('click', function (e) {
            e.preventDefault();
            var isDark = html.getAttribute('data-bs-theme') === 'dark';
            var next = isDark ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', next);
            window.localStorage.setItem('tabler-theme', next);
            syncIcon();
        });
    });
</script>
