<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.Name','Customer Page') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('vendors/dist/css/adminlte.min.css') }}">



        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body class="hold-transition sidebar-mini">
        @include('sweet::alert')
        
        <div class="wrapper">
            {{-- 1. Top Menu  --}} @include('layoutsCustomer.topMenu') 
            {{-- 2. Left Menu --}} @include('layoutsCustomer.leftMenu') 
            {{-- 3. Main Content (Body) --}}
            <!-- Main content -->
            <section class="content"> @yield('content') </section>
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('vendors/dist/js/adminlte.min.js') }}"></script>
        <!-- Checking jQuery -->

<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://jqueryvalidation.org/files/lib/jquery-1.11.1.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    </body>
</html>