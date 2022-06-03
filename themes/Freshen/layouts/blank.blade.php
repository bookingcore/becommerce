<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ theme_url('Freshen') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ theme_url('Freshen') }}/css/style.css">
    <link rel="stylesheet" href="{{ theme_url('Freshen') }}/css/responsive.css">
    <link href="{{ theme_url('Freshen/dist/css/app.css?_v='.config('app.asset_version')) }}" rel="stylesheet">
    @include('layouts.parts.seo-meta')
    <link rel="stylesheet" href="{{ route('core.style.customCss') }}">
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
            search:{
                driver:'{{$driver = get_search_engine()}}',
                app_id:'{{setting_item($driver.'_app_id',config('scount.algolia.id'))}}',
                public_key:'{{setting_item($driver.'_public',config('scount.algolia.public'))}}'
            },
            is_api:{{is_api() ? 1 : 0}}
        }
        var i18n = {
            warning:"{{__("Warning")}}",
            success:"{{__("Success")}}",
            please_fill_out:'{{__("Please fill out this field.")}}',
            delete_cart_item_confirm:'{{__("Do you want to delete this cart item?")}}',
            main_menu:'{{__("Main Menu")}}',
        };
    </script>
    @yield('head')
</head>
<body class="{{$body_class ?? ''}}">
<div class="wrapper ovh">
    @yield('content')
</div>
<script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
<script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
<script src="{{asset('libs/lodash.min.js')}}"></script>
<script>

    window.lazyLoadOptions = {
        elements_selector: ".lazy",
    };

    window.addEventListener('LazyLoad::Initialized', function (event) {
        window.lazyLoadInstance = event.detail.instance;
    }, false);


</script>
<script src="{{ theme_url('Base') }}/libs/vue/vue{{!config('app.script_debug') ? '.min' : '' }}.js"></script>
<script src="{{ theme_url('Freshen') }}/js/jquery-3.6.0.js"></script>
<script src="{{ theme_url('Freshen') }}/js/popper.min.js"></script>
<script src="{{ theme_url('Freshen') }}/js/bootstrap.min.js"></script>

<!-- Custom script for all pages -->
<script  src="{{ theme_url('Freshen/js/app.js?_v='.config('app.asset_version')) }}"></script>
@yield('footer')
</body>
</html>
