@if(is_api())
    @include('layouts.blank')
    <?php return ?>
@endif
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 scroll-smooth {{$html_class ?? ''}}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/owl-carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/owl-carousel/assets/owl.theme.default.min.css">
        <link href="{{ mix('/dist/css/general.css','themes/zeomart') }}" rel="stylesheet">
        <link href="{{ mix('/dist/css/home.css','themes/zeomart') }}" rel="stylesheet">

        @include('layouts.parts.seo-meta')
        {{--Custom Style--}}
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
                @if($driver = get_search_engine())
                search:{
                    driver:'{{$driver}}',
                    app_id:'{{setting_item($driver.'_app_id',config('scount.algolia.id'))}}',
                    public_key:'{{setting_item($driver.'_public',config('scount.algolia.public'))}}'
                }
                @endif
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
    <body class="{{$body_class ?? ''}}">
        <main class="shrink-0">
            @include('layouts.parts.header')
            @yield('content')
        </main>
        <footer class="footer mt-5 py-5 border-t">
            @include('layouts.parts.footer')
            @include('product.compare.compare-modal')

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

            <script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/owl-carousel/owl.carousel.min.js"></script>
            <script src="{{ theme_url('Base') }}/libs/vue/vue.js"></script>
            @switch(setting_item('search_driver'))
                @case ('algolia')
                <script  src="{{ theme_url('Base/dist/module/search/algolia.js?_v='.config('app.asset_version')) }}"></script>
                @break
            @endswitch
            <!-- custom scripts-->
            <script  src="{{ theme_url('Base/js/app.js?_v='.config('app.asset_version')) }}"></script>
            <script  src="{{ theme_url('Zeomart/dist/js/dev.js?_v='.config('app.asset_version')) }}"></script>
            @stack('footer')
        </footer>
    </body>
</html>
