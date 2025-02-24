<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>FlexStart Bootstrap Template - Index</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('flex-start/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('flex-start/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('flex-start/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('flex-start/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('flex-start/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('flex-start/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('flex-start/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('flex-start/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('flex-start/css/style.css') }}" rel="stylesheet">

        <!-- =======================================================
        * Template Name: FlexStart
        * Updated: May 30 2023 with Bootstrap v5.2.3
        * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>

    <body>
        @include('layouts.header-flex')

        @yield('content')

        @include('layouts.footer-flex')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('flex-start/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('flex-start/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('flex-start/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('flex-start/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('flex-start/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('flex-start/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('flex-start/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('flex-start/js/main.js') }}"></script>

    </body>

</html>