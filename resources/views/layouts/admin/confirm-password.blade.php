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

    <title>Conferma password &mdash; {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon_admin.ico') }}">

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css">

    <!-- Tabler Themes CSS -->
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

    <!-- Custom CSS (sovrascrive i preset colore di tabler-themes.css) -->
    @vite('resources/css/app.css')

    @yield('style')
</head>

<body class="antialiased d-flex flex-column">
    {{-- Anti-flash: riapplica la modalità chiara/scura salvata nel browser --}}
    <script>
        (function () {
            var stored = window.localStorage.getItem('tabler-theme');
            if (stored) {
                document.documentElement.setAttribute('data-bs-theme', stored);
            }
        })();
    </script>
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
        <div class="container-tight py-6">

            {{-- Logo --}}
            <div class="text-center mb-4">
                <a href="{{ homeRoute() }}">
                    <img src="/images/logo@2x.png" height="40" alt="{{ config('app.name') }}"
                        onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                    <span style="display:none; font-size:1.5rem; font-weight:700; color:#206bc4;">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            @yield('content')

        </div>
    </div>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @yield('script')
</body>

</html>
