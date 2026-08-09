@php
    $adminTheme = adminThemeSettings();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-bs-theme="{{ $adminTheme['mode'] === 'auto' ? 'light' : $adminTheme['mode'] }}"
    data-bs-theme-primary="{{ $adminTheme['primary'] }}"
    data-bs-theme-base="{{ $adminTheme['base'] }}"
    data-bs-theme-font="{{ $adminTheme['font'] }}"
    data-bs-theme-radius="{{ $adminTheme['radius'] }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {!! config('app.env') != 'production' ? '[ ' . Str::ucfirst(config('app.env')) . ' ] &mdash; ' : '' !!}
        {{ userReadableAppSectionName(1) }}&nbsp;&mdash;&nbsp;
        {{ config('app.name', 'Boilerplate') }}
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon_admin.ico') }}">

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css">

    <!-- Tabler Themes CSS (preset colore/base/font/raggio, letti da ADMIN_THEME_* in .env) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-themes.min.css">

    <!-- Bunny Fonts (alternativa GDPR-friendly a Google Fonts, font configurabile via ADMIN_FONT_FAMILY) -->
    <link rel="stylesheet" href="{{ adminBunnyFontCssUrl() }}">
    <style>
        :root {
            --tblr-font-sans-serif: '{{ config('admin-theme.font_family', 'Inter') }}', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
    </style>

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.0.0/dist/tabler-icons.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

    <!-- Custom CSS (sovrascrive DataTables/Dropzone dopo i CSS di libreria) -->
    @vite('resources/css/app.css')

    @yield('style')

    <!-- Vue.js 3 -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body class="antialiased">

    {{--
        Script "anti-flash": riapplica subito, prima che la pagina venga
        dipinta, la modalità chiara/scura scelta dall'utente (salvata nel
        localStorage del browser tramite il toggle luna/sole in topbar).
        Colore primario, base, font e raggio angoli sono impostati solo
        via .env (vedi config/admin-theme.php) e non sono più modificabili
        a runtime.
    --}}
    <script>
        (function () {
            var stored = window.localStorage.getItem('tabler-theme');
            if (stored) {
                document.documentElement.setAttribute('data-bs-theme', stored);
            }
        })();
    </script>

    {{-- Banner di impersonazione: visibile solo quando un admin sta navigando "come" un altro utente --}}
    @impersonating
        {{-- .alert di Tabler è display:flex internamente: text-center non centra i figli,
             serve justify-content-center (+ flex-wrap per il wrap su schermi stretti). --}}
        <div class="alert alert-warning sticky-top rounded-0 mb-0 py-2 d-flex flex-wrap justify-content-center align-items-center d-print-none" style="z-index: 1031;">
            <i class="ti ti-user-shield me-1"></i>
            Stai navigando come <strong>{{ Auth::user()->name }}</strong>.
            <a href="{{ route('impersonate.leave') }}" class="alert-link ms-2">
                <i class="ti ti-logout-2 me-1"></i>Torna al tuo account
            </a>
        </div>
    @endImpersonating

    {{-- Root: class="page" è la classe corretta di Tabler per il layout con sidebar --}}
    <div class="page">

        {{-- Sidebar --}}
        @include('layouts.admin.lsidebar')

        {{-- Page wrapper --}}
        <div class="page-wrapper">

            {{-- Top header --}}
            @include('layouts.admin.topbar')

            {{--
                Le viste gestiscono direttamente page-header e page-body,
                ognuna con il proprio container-xl al proprio interno.
                Struttura corretta Tabler:
                  page-header > container-xl > row g-2
                  page-body   > container-xl > row row-cards
            --}}
            @yield('content') 
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Page Scripts -->
    @yield('script')

</body>

</html>
