@if(is_api())
    @include('layouts.blank')
    <?php return ?>
@endif
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="{{ theme_url('Demus') }}/libs/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ theme_url('Demus') }}/libs/nouislider/nouislider.min.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="{{ theme_url('Demus/style.css') }}" rel="stylesheet">
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
                @if($driver = get_search_engine())
                search:{
                    driver:'{{$driver}}',
                    app_id:'{{setting_item($driver.'_app_id',config('scount.algolia.id'))}}',
                    public_key:'{{setting_item($driver.'_public',config('scount.algolia.public'))}}'
                }
                @endif
            };
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
            @include('layouts.parts.header')
            @yield('content')

        </main>
        <footer class="footer mt-auto py-3">
            @include('layouts.parts.footer')
            @include('product.compare.compare-modal')
        </footer>
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
        <script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
        <script src="{{asset('libs/lodash.min.js')}}"></script>
        {{--<script src="{{ theme_url('Demus') }}/libs/slick/slick.js"></script>--}}
        <script>

            window.lazyLoadOptions = {
                elements_selector: ".lazy",
            };

            window.addEventListener('LazyLoad::Initialized', function (event) {
                window.lazyLoadInstance = event.detail.instance;
            }, false);


        </script>

        <script src="{{ theme_url('Demus') }}/js/jquery.min.js"></script>
        <script src="{{ theme_url('Demus') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ theme_url('Demus') }}/libs/vue/vue.js"></script>
        <script src="{{ theme_url('Demus') }}/libs/nouislider/nouislider.min.js"></script>
        @switch(setting_item('search_driver'))
            @case ('algolia')
                <script  src="{{ theme_url('Demus/dist/module/search/algolia.js?_v='.config('app.asset_version')) }}"></script>
                @break
        @endswitch
        <!-- custom scripts-->
        <script  src="{{ theme_url('Demus/js/app.js?_v='.config('app.asset_version')) }}"></script>
        @stack('footer')
    </body>
</html>
