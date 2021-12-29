<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/owl-carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/owl-carousel/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/slick/slick/slick.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/nouislider/nouislider.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/lightGallery-master/dist/css/lightgallery.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/css/style.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/css/market-place-1.css">
        <link href="{{ theme_url('Base/dist/css/app.css') }}" rel="stylesheet">
        @include('layouts.parts.seo-meta')
        {!! \App\Helpers\Assets::css() !!}
        {!! \App\Helpers\Assets::js() !!}
        @yield('head')
    </head>
    <body class="d-flex flex-column h-100 {{$body_class ?? ''}}">
        <main class="flex-shrink-0">
            @include('layouts.parts.header')
            @yield('content')

        </main>
        <footer class="footer mt-auto py-3 bg-light">
            @include('layouts.parts.footer')

            <script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
            <script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
            <script>

                window.lazyLoadOptions = {
                    elements_selector: ".lazy",
                };

                window.addEventListener('LazyLoad::Initialized', function (event) {
                    window.lazyLoadInstance = event.detail.instance;
                }, false);


            </script>

            <script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/jquery.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/nouislider/nouislider.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/popper.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/owl-carousel/owl.carousel.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/imagesloaded.pkgd.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/masonry.pkgd.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/isotope.pkgd.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/jquery.matchHeight-min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/slick/slick/slick.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/slick-animation.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
            <script src="{{ theme_url('Base') }}/plugins/select2/dist/js/select2.full.min.js"></script>
            <script src="{{ theme_url('Base') }}/js/main.js"></script>
            <!-- custom scripts-->
            <script  src="{{ theme_url('Base/js/app.js') }}"></script>
            @yield('footer')
        </footer>
    </body>
</html>
