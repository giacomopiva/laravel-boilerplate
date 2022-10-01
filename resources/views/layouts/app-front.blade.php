@php
/**
 * @author		Giacomo Piva <gpiva@innovativa.it>
 * @category	Layout file
 * @version    	1.0
 * @see        	https://themes.getbootstrap.com/product/front-multipurpose-responsive-template/
 */	
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon-->
		<link rel="shortcut icon" href="{{  asset('images/favicon.ico') }}">

		<!-- Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

		<!-- CSS Implementing Plugins -->
		<link rel="stylesheet" href="{{ asset('/front/vendor/bootstrap-icons/font/bootstrap-icons.css') }} ">
		<link rel="stylesheet" href="{{ asset('/front/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }} ">
		<link rel="stylesheet" href="{{ asset('/front/vendor/aos/dist/aos.css') }} ">

		<!-- CSS Front Template -->
		<link rel="stylesheet" href="{{ asset('/front/css/theme.min.css') }} ">
    </head>

    <body>
        @include('layouts.header')
        
        @yield('content')
        
        @include('layouts.footer')

        <!-- JS Global Compulsory  -->
        <script src="{{ asset('front/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

        <!-- JS Implementing Plugins -->
        <script src="{{ asset('front/vendor/hs-header/dist/hs-header.min.js') }}"></script>
        <script src="{{ asset('front/vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
        <script src="{{ asset('front/vendor/hs-show-animation/dist/hs-show-animation.min.js') }}"></script>
        <script src="{{ asset('front/vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
        <script src="{{ asset('front/vendor/aos/dist/aos.js') }}"></script>

        <!-- JS Front -->
        <script src="{{ asset('front/js/theme.min.js') }}"></script>

        <!-- JS Custom -->
        <script src="{{ asset('front/js/theme-custom.js') }}"></script>

        <!-- JS Plugins Init. -->
        <script>
        (function() {
            // INITIALIZATION OF HEADER
            // =======================================================
            new HSHeader('#header').init()


            // INITIALIZATION OF MEGA MENU
            // =======================================================
            new HSMegaMenu('.js-mega-menu', {
                desktop: {
                position: 'left'
                }
            })


            // INITIALIZATION OF SHOW ANIMATIONS
            // =======================================================
            new HSShowAnimation('.js-animation-link')


            // INITIALIZATION OF BOOTSTRAP VALIDATION
            // =======================================================
            HSBsValidation.init('.js-validate', {
            onSubmit: data => {
                data.event.preventDefault()
                alert('Submited')
            }
            })


            // INITIALIZATION OF BOOTSTRAP DROPDOWN
            // =======================================================
            HSBsDropdown.init()


            // INITIALIZATION OF GO TO
            // =======================================================
            new HSGoTo('.js-go-to')


            // INITIALIZATION OF AOS
            // =======================================================
            AOS.init({
            duration: 650,
            once: true
            });
        })()
        </script>        
    </body>
</html>
