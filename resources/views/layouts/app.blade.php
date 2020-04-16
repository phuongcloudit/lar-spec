<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="robots" content="noindex">
		<title>Special Thanks</title>
		<link rel="stylesheet" href="{{ asset('/assets/css/normalize.css') }}">
		<link rel="stylesheet" href="{{ asset('/assets/css/style.min.css?v='.filemtime(public_path('assets/css/style.css'))) }}">
	</head>
	<body class="<?php echo \Route::current()->getName();?>">
		@include('includes.header')
        @yield('content')
        @include('includes.footer')
        <link rel="stylesheet" href="{{ asset('/assets/css/fonts.css') }}">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
	    <script src="{{ asset('/assets/js/lightslider.js') }}"></script>
	    <script>
	        $(document).ready(function() {
	           $('#image-gallery').lightSlider({
	               gallery:true,
	               item:1,
	               thumbItem:4,
	               slideMargin: 0,
	               speed:500,
	               auto:false,
	               loop:true,
	               onSliderLoad: function() {
	                   $('#image-gallery').removeClass('cS-hidden');
	               }  
	           });
	       });
	   </script>
	    <script>
	        $(".slide-spec").owlCarousel({
	            items: 6,
	            loop: true,
	            responsiveClass: true,
	            nav: true,
	            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
	            autoplay: false,
	            autoplayTimeout: 3500,
	            dots: false,
	            smartSpeed: 1000,
	            // mouseDrag: false,
	            // touchDrag: true,
	            responsive: {
	                0: {
	                    items: 1,
	                    margin: 40
	                },
	                768: {
	                    items: 1,
	                    margin: 40
	                }
	            }
	        })
	    </script>
	</body>
</html>