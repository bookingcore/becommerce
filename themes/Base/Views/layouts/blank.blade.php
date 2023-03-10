<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/bootstrap/css/bootstrap.min.css">
    <link href="{{ theme_url('Base/dist/css/app.css') }}" rel="stylesheet">
    @include('layouts.parts.seo-meta')
    {!! \App\Helpers\Assets::css() !!}
    {!! \App\Helpers\Assets::js() !!}
    <script>
        var BC = {
            url: '{{url('/')}}',
            routes:{
                login:'{{route('login')}}',
                register:'{{route('register')}}',
            },
            booking_decimals:'{{ (int)get_current_currency('currency_no_decimal',2) }}',
            thousand_separator:'{{ get_current_currency('currency_thousand') }}',
            decimal_separator:'{{ get_current_currency('currency_decimal') }}',
            currency_position:'{{ get_current_currency('currency_format') }}',
            currency_symbol:'{{ currency_symbol() }}',
            currency_rate:'{{ get_current_currency('rate',1) }}',
            is_api:{{is_api() ? 1 : 0}}
        }
        var i18n = {
            warning:"{{__("Warning")}}",
            success:"{{__("Success")}}",
            please_fill_out:'{{__("Please fill out this field.")}}',
            delete_cart_item_confirm:'{{__("Do you want to delete this cart item?")}}',
        };
    </script>
    @stack('head')
</head>
<body class="d-flex flex-column h-100 {{$body_class ?? ''}}">
    <main class="flex-shrink-0">
        @yield('content')
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

    <script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
    <script src="{{ theme_url('Base') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('libs/vue/vue.js') }}"></script>
    <!-- custom scripts-->
    <script  src="{{ theme_url('Base/js/app.js') }}"></script>
    @stack('footer')
</body>
</html>
