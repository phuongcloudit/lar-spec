<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
</head>

<body class="indedx">
    <header>
        @include('includes.header')
    </header>
    <main>
        @yield('content')
    </main>

    <footer>
        @include('includes.footer')
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    
    <script>
        $(".slide-spec").owlCarousel({
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
                    items: 3,
                    margin: 0
                },
                768: {
                    items: 1,
                    margin: 0
                }
            }
        })
    </script>
</body>

</html>