@php
/**
 * @author		Giacomo Piva <gpiva@innovativa.it>
 * @category	Layout file
 * @version    	1.0
 * @see        	https://getuikit.com/
 * @see			https://getuikit.com/docs/introduction
 * 
 * @see         https://github.com/zzseba78/Kick-Off
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
        <link rel="icon" href="/favicon.ico" type="image/x-icon">

        <!-- UiKit -->
	    <link rel="stylesheet" type="text/css" href="{{ asset('uikit-3.14.1/css/uikit.min.css') }}">
        <script src="{{ asset('uikit-3.14.1/js/uikit.min.js') }}"></script>
        <script src="{{ asset('uikit-3.14.1/js/uikit-icons.min.js') }}"></script>        
    </head>

    <body>
        <div class="uk-container">
            @yield('content')
        </div>
    </body>
</html>
