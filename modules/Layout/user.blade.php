<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($favicon = setting_item('site_favicon'))
    <link rel="icon" type="image/png" href="{{!empty($favicon)?get_file_url($favicon,'full'):url('images/favicon.png')}}" />
    @include('Layout::parts.seo-meta')
    <link href="{{ asset('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}" >
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' id='google-font-css' href='https://fonts.googleapis.com/css?family=Work+Sans%3A300%2C400%2C500%2C600%2C700&subset=latin%2Clatin-ext&ver=20170801' type='text/css' media='all' />
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
            }
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
            currentUser:{{(int)Auth::id()}},
            variations: [],
            currentVariation: [],
            compare_count: ''
        };
    </script>
    <link href="{{ asset('dist/frontend/module/user/css/user.css') }}" rel="stylesheet">
    <!-- Styles -->
    @yield('head')
    <style type="text/css">
        html, body, .bravo_wrap, .bravo_user_profile,
        .bravo_user_profile > .container-fluid > .row-eq-height > .col-md-3 {
            min-height: 100vh !important;
        }
        .bravo_topbar, .bravo-header, .bravo_footer{
            display: none;
        }
    </style>

    <link href="{{ route('core.style.customCss') }}" rel="stylesheet">
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
</head>
<body class="{{$body_class ?? ''}}">
    {!! clean(setting_item('body_scripts')) !!}
    <div class="bravo_wrap">
        @include('Layout::parts.topbar')
        @include('Layout::parts.header')

        <div class="bravo_user_profile">
            <div class="container-fluid">
                <div class="row row-eq-height">
                    <div class="col-md-3">
                        @include('User::frontend.layouts.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="user-form-settings">
                            @include('Layout::parts.user-bc')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Layout::parts.footer',['is_user_page'=>1])
    </div>
    {!! clean(setting_item('footer_scripts')) !!}
</body>
</html>
