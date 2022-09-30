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
		<link rel="shortcut icon" href="./favicon.ico">

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
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
