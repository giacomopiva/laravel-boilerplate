
@php
/**
 * @author		Giacomo Piva <gpiva@innovativa.it>
 * @category	Layout file
 * @version    	1.0
 * @see        	https://getbootstrap.com/
 * @see			https://getbootstrap.com/docs/4.6/getting-started/introduction/
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

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/img/favicons/manifest.json">
        <link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <link rel="icon" href="/img/favicons/favicon.ico">

        <meta name="theme-color" content="#7952b3">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.6.1-dist/css/bootstrap.min.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
            <script src="{{ asset('bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js') }}"></script>        
        </div>
    </body>
</html>
