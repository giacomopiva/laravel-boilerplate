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

        .login-page {
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

    @if (config('app.env') != 'local')
    {!! htmlScriptTagJsApi([
        'action' => 'homepage',
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch'
    ]) !!}
    @endif 
</head>

<body class="login-page" style="max-width:80%;">
    
    <div class="custom-shape-divider-bottom-1667063732">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="row" style="margin-top:20%;">
        <div class="col-md-6">
            <div class="login-box"> 
                <div class="logo">
                    <a href="javascript:void(0);">
                        <a href="javascript:void(0);">Accedi a {{ config('app.name', 'Laravel') }}</b></a>
                    </a>
                    <hr />
                    <p style="color:#fff; font-size:18px;">
                        Lorem ipsum dolor quì quò quà sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.                         
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-md-offset-1">
            <div class="login-box"> 
                <div class="card">
                    <div class="body">
                        <form id="sign_in" method="POST" action="{{ route('login') }}">
                            @csrf
        
                            <div class="msg" style="font-size:18px;">                                
                                <img src="{{ config('app.url') . '/images/' . config('custom.logo_name') }}" 
                                     height="50" 
                                     alt="{{ config('app.name') }}" />                                
                                
                                <div class="msg" style="margin-top: 15px">
                                    @error('disabled')
                                        <span style="color: #dc3545;">{{ $message }}</span>
                                    @else
                                        <span>Inserisci le tue credenziali</span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <div class="form-line">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-8 p-t-5">
                                    <input class="filled-in chk-col-blue" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                                    <label for="remember">{{ __('Remember Me') }}</label>
                                </div>
                                <div class="col-xs-4 align-right">
                                    <button class="btn btn-block btn-primary waves-effect" type="submit" style="max-width:90px;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
        
                            <div class="row m-t-15 m-b--20">
                                @if (false)
                                <div class="col-xs-6">
                                    <a href="">{{ __('Register Now!') }}</a>
                                </div>
                                @endif
        
                                @if (Route::has('password.request'))
                                <div class="col-xs-6 ">
                                    <a href="{{ route('password.request') }}" class="col-blue-grey"> {{ __('Forgot Your Password?') }}</a>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
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
