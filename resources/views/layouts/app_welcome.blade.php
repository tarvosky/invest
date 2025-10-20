<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Autoverified') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Smart Investing. Real Returns! We provide powerful financial growth opportunities through diversified investments. Our platform simplifies the complex world of investing, helping you secure a brighter financial tomorrow" />
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/misc-pages.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @yield('css')


</head>
<body>
    <div id="app">
        <body class="simple-page">


            @yield('content')


        <!-- Footer -->



    @stack('scripts')
</body>
</html>
