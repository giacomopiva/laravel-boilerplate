@php
/**
 * @author		Giacomo Piva <gpiva@innovativa.it>
 * @category	Layout file
 * @version    	1.0
 * @see        	https://github.com/gurayyarar/AdminBSBMaterialDesign
 * @see			https://gurayyarar.github.io/AdminBSBMaterialDesign/index.html
 * @see 		https://getbootstrap.com/docs/3.3/
 */	
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Log In {{ config('app.name', 'Laravel') }}</title>

    <!-- Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Favicon-->
    <link rel="shortcut icon" href="{{  asset('images/favicon_admin.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">

    <!-- Waves Effect Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/node-waves/waves.css') }}">

    <!-- Animation Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/animate-css/animate.css') }}">

    <!-- AdminBSB Theme -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/theme-white.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/custom.css') }}">
    
    <style>
        .custom-shape-divider-bottom-1667063732 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1667063732 svg {
            position: relative;
            display: block;
            width: calc(165% + 1.3px);
            height: 370px;
        }

        .custom-shape-divider-bottom-1667063732 .shape-fill {
            fill: #FFFFFF;
        }
        
        .card {
            border-radius: 10px;
        }

        .fp-page {
            background-color: #1F91F3;
        }

        .btn:not(.btn-link):not(.btn-circle) {
            min-width: 80px;
            border-radius: 5px;
        }
    </style>

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</head>

<body class="fp-page">
    <div class="custom-shape-divider-bottom-1667063732">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Accedi a {{ config('app.name', 'Laravel') }}</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div class="msg">
                        Inserisci l'indirizzo email che utilizzi per fare l'accesso. Ti invieremo un link per poter reimpostare la password.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus autocomplete="email">                
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect btn-primary" type="submit">{{ __('Send Password Reset Link') }}</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{ url('login') }}" class="col-blue-grey">{{ __('Back to Log In') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery Validation Plugin -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

    <script src="{{ asset('js/admin/admin.js' ) }}"></script>
</body>

</html>
