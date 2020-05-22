<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $favicon = setting_item('site_favicon');
    @endphp
    @if($favicon)
        @php
            $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
        @endphp
        @if(!empty($file))
            <link rel="icon" type="{{$file['file_type']}}" href="{{asset('uploads/'.$file['file_path'])}}" />
        @else:
            <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />
        @endif
    @endif

    @include('Layout::parts.seo-meta')
    <link href="{{ asset('libs/jquery_ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/icons/css/set.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/frontend/css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' id='google-font-css'  href='https://fonts.googleapis.com/css?family=Work+Sans%3A300%2C400%2C500%2C600%2C700&subset=latin%2Clatin-ext&ver=20170801' type='text/css' media='all' />
    {!! \App\Helpers\Assets::css() !!}
    {!! \App\Helpers\Assets::js() !!}
    <script>
        var bookingCore = {
            url:'{{url( app_get_locale() )}}',
            booking_decimals:{{(int)setting_item('currency_no_decimal',2)}},
            thousand_separator:'{{setting_item('currency_thousand')}}',
            decimal_separator:'{{setting_item('currency_decimal')}}',
            currency_position:'{{setting_item('currency_format')}}',
            currency_symbol:'{{currency_symbol()}}',
            date_format:'{{get_moment_date_format()}}',
            map_provider:'{{setting_item('map_provider')}}',
            map_gmap_key:'{{setting_item('map_gmap_key')}}',
            routes:{
                login:'{{route('auth.login')}}',
                register:'{{route('auth.register')}}',
            },
            currentUser:{{(int)Auth::id()}}
        };
        var Bravo = {
            url:'{{url( app_get_locale() )}}',
            url_root:'{{ url('') }}',
            booking_decimals:{{(int)get_current_currency('currency_no_decimal',2)}},
            thousand_separator:'{{get_current_currency('currency_thousand')}}',
            decimal_separator:'{{get_current_currency('currency_decimal')}}',
            currency_position:'{{get_current_currency('currency_format')}}',
            currency_symbol:'{{currency_symbol()}}',
            currency_rate:'{{get_current_currency('rate',1)}}',
            date_format:'{{get_moment_date_format()}}',
            map_provider:'{{setting_item('map_provider')}}',
            map_gmap_key:'{{setting_item('map_gmap_key')}}',
            routes:{
                login:'{{route('auth.login')}}',
                register:'{{route('auth.register')}}',
                add_to_cart:'{{route('booking.addToCart')}}'
            },
            currentUser:{{(int)Auth::id()}}
        };
        var i18n = {
            warning:"{{__("Warning")}}",
            success:"{{__("Success")}}",
        };
    </script>
    <!-- Styles -->
    @yield('head')
    {{--Custom Style--}}
    @include('Layout::parts.custom-css')
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
</head>
<body class="{{$body_class ?? ''}}">
    {!! setting_item('body_scripts') !!}
    <div class="bravo_wrap">
{{--        @include('Layout::parts.adminbar')--}}
        @include('Layout::parts.header')
        @include('Layout::parts.bc')
        @yield('content')
        @include('Layout::parts.footer')

    </div>
    {!! setting_item('footer_scripts') !!}
</body>
</html>
