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

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Favicon-->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">

    <!-- Waves Effect Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/node-waves/waves.css') }}">

    <!-- Animation Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/animate-css/animate.css') }}">

    <!-- Sweetalert Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">

    <!-- Morris Chart Css-->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/morrisjs/morris.css') }}">

    <!-- JQuery DataTable Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

    <!-- Bootstrap Select Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">

    <!-- Multi Select Css -->
    <link href="{{ asset('plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Dropzone Css -->
    <link href="{{ asset('plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- AdminBSB Theme -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/theme-custom.css') }}">

    <!-- Custom Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/custom.css') }}">
    
    @yield('style')

	<!-- Vue JS ed Axios -->
    @if (config('app.env') === 'production')
	    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.min.js"></script>
    @else
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    @endif

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body class="theme-white">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
	
	<!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
	
	@include('layouts.admin.topbar')

	<section>
		@include('layouts.admin.lsidebar')
    </section>

    <section class="content">
		@yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    
    <!-- Dropzone Plugin Js -->
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>

    <!-- Sparkline Plugin Js -->
    <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
    
    <!-- Notification -->
    <script src="{{ asset('js/pages/ui/notifications.js') }}"></script>
    
    @php
    /*<!-- Flot Charts Plugin Js -->
    <script src="{{ asset('plugins/flot-charts/jquery.flot.js' ) }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.resize.js' ) }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.pie.js' ) }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js' ) }}"></script>
	<script src="{{ asset('plugins/flot-charts/jquery.flot.time.js' ) }}"></script>
    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js' ) }}"></script>*/
    @endphp

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    
    <!-- Moment Js -->
    <script src="{{ asset('js/moment.min.js' ) }}"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

    <!-- Custom Js -->
	<script src="{{ asset('js/admin/script.js' ) }}"></script>

    <!-- View's Js -->
    @yield('script')

    <script src="{{ asset('js/admin/admin.js' ) }}"></script>

    <!-- Demo Js -->
    @php /*<script src="{{ asset('js/demo.js' ) }}"></script>*/ @endphp
    
</body>

</html>
