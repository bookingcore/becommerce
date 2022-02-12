<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ theme_url('Axtronic/style.css') }}" rel="stylesheet">
        @include('layouts.parts.seo-meta')
        {!! \App\Helpers\Assets::css() !!}
        {!! \App\Helpers\Assets::js() !!}
        <script>
            var BC = {
                url: '{{url( app_get_locale() )}}',
            }
            var i18n = {
                warning:"{{__("Warning")}}",
                success:"{{__("Success")}}",
                please_fill_out:'{{__("Please fill out this field.")}}',
                delete_cart_item_confirm:'{{__("Do you want to delete this cart item?")}}',
            };
        </script>
        @yield('head')
    </head>
    <body class="{{$body_class ?? ''}}">
        @include('layouts.parts.header')
        <main class="flex-shrink-0">
            @yield('content')
        </main>
        <footer class="footer mt-auto py-3">
            @include('layouts.parts.footer')
            @include('product.compare.compare-modal')

            <script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
            <script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
            <script async src="{{asset('libs/bootbox/bootbox.all.min.js')}}"></script>
            <script>

                window.lazyLoadOptions = {
                    elements_selector: ".lazy",
                };

                window.addEventListener('LazyLoad::Initialized', function (event) {
                    window.lazyLoadInstance = event.detail.instance;
                }, false);


            </script>

            <script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/owl-carousel/owl.carousel.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/vue/vue.js"></script>
            <script src="{{ theme_url('Base') }}/libs/nouislider/nouislider.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/slick/slick.min.js"></script>
            <!-- custom scripts-->
            <script  src="{{ theme_url('Base/js/app.js') }}"></script>
            @yield('footer')
        </footer>
    </body>
</html>
