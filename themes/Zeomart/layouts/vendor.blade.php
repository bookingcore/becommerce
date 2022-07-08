<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="{{ theme_url('zeomart/dist/css/general.css?v='.config('app.asset_version')) }}" rel="stylesheet">
    <link href="{{ theme_url('zeomart/dist/css/vendor.css?v='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/font-awesome/css/font-awesome.min.css">
    <link href="{{ theme_url('zeomart/icon/font/flaticon.css') }}" rel="stylesheet">

    @include('layouts.parts.seo-meta')
    {!! \App\Helpers\Assets::css() !!}
    {!! \App\Helpers\Assets::js() !!}
    <script>
        var BC = {
            url:'{{url('/')}}',
            media:{
                routes:{
                    removeFiles:'{{route('media.removeFiles')}}',
                    store:'{{route('media.store')}}',
                    getLists:'{{route('media.getLists')}}',
                },
                groups:{!! json_encode(config('bc.media.groups')) !!}
            }
        }
        var i18n = {
            warning:"{{__("Warning")}}",
            success:"{{__("Success")}}",
            confirm_delete:"{{__("Do you want to delete?")}}",
            confirm_recovery:"{{__("Do you want to restore?")}}",
            confirm:"{{__("Confirm")}}",
            cancel:"{{__("Cancel")}}",
        };
    </script>
    @stack('head')
</head>
<body class=" {{$body_class ?? ''}}">
@include('layouts.vendor.header')

<div class="flex gap-7  px-7 bravo_wrap">
    <div class="w-1/6">
        @include('layouts.vendor.sidebar')
    </div>
    <main class="w-5/6 p-14 rounded-[16px] bg-[#F3F5F6]">
        @yield('content')
    </main>
</div>
@include('Media::browser',['tailwind'=>1])
<script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
<script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
<script src="{{asset('libs/lodash.min.js')}}"></script>
<script src="{{asset('libs/vue/vue.min.js')}}"></script>
<script>

    window.lazyLoadOptions = {
        elements_selector: ".lazy",
    };

    window.addEventListener('LazyLoad::Initialized', function (event) {
        window.lazyLoadInstance = event.detail.instance;
    }, false);


</script>

<script src="{{ theme_url('Base') }}/js/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content'),
            'Accept':'application/json'
        }
    });
</script>
<script  src="{{ theme_url('Zeomart/dist/js/vendor.js?_v='.config('app.asset_version')) }}"></script>
<script src="{{ asset('module/media/js/browser.js?_ver='.config('app.asset_version')) }}"></script>
<!-- custom scripts-->
@stack('footer')
</body>
</html>
