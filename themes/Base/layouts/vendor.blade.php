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
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/owl-carousel/assets/owl.carousel.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/vendor/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/vendor/plugins/apexcharts-bundle/dist/apexcharts.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/vendor/css/style.css">
        <link href="{{ theme_url('Base/dist/css/app.css') }}" rel="stylesheet">
        @include('layouts.parts.seo-meta')
        {!! \App\Helpers\Assets::css() !!}
        {!! \App\Helpers\Assets::js() !!}
        @yield('head')
    </head>
    <body class=" {{$body_class ?? ''}}">
        <main class="ps-main">
            @include('layouts.vendor.sidebar')
            <div class="ps-main__wrapper">
                @include('layouts.vendor.header')
                @yield('content')
            </div>
        </main>
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

        <!-- custom code-->
        <script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
        <script src="{{ theme_url('Base') }}/plugins/popper.min.js"></script>
        <script src="{{ theme_url('Base') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ theme_url('Base') }}/plugins/jquery.matchHeight-min.js"></script>
        <script src="{{ theme_url('Base') }}/plugins/select2/dist/js/select2.full.min.js"></script>
        <script src="{{ theme_url('Base') }}/vendor/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="{{ theme_url('Base') }}/vendor/plugins/apexcharts-bundle/dist/apexcharts.min.js"></script>

        <script src="{{ asset('libs/bootbox/bootbox.all.min.js') }}"></script>
        <script src="{{ theme_url('Base') }}/vendor/js/main.js"></script>
        <!-- custom scripts-->
        <script  src="{{ theme_url('Base/js/app.js') }}"></script>
        @yield('footer')
    </body>
</html>
