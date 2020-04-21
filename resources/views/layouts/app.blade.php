<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="robots" content="noindex">
<title>@stack('meta','Special Thanks')</title>
@stack('meta')
<link rel="stylesheet" href="{{ asset('/assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/style.css?v='.filemtime(public_path('assets/css/style.css'))) }}">
@stack('head')
</head>
<body class="<?php echo \Route::current()->getName();?>">
@include('includes.header')
@yield('content')
@include('includes.footer')
<link rel="stylesheet" href="{{ asset('/assets/css/fonts.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@stack('scripts')
</body>
</html>