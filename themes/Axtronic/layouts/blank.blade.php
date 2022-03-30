<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
<head>
    <!-- Required meta tags -->
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
    <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ theme_url('Base') }}/libs/bootstrap/css/bootstrap.min.css">
    <link href="{{ theme_url('Base/dist/css/app.css') }}" rel="stylesheet">
    @include('layouts.parts.seo-meta')
    {!! \App\Helpers\Assets::css() !!}
    {!! \App\Helpers\Assets::js() !!}
    <script>
        var i18n = {
            warning:"{{__("Warning")}}",
            success:"{{__("Success")}}",
            please_fill_out:'{{__("Please fill out this field.")}}',
            delete_cart_item_confirm:'{{__("Do you want to delete this cart item?")}}',
        };
    </script>
    @yield('head')
</head>
<body class="d-flex flex-column h-100 {{$body_class ?? ''}}">
<main class="flex-shrink-0">
    @yield('content')
</main>
<footer class="footer mt-auto py-3">

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
    <!-- custom scripts-->
    <script  src="{{ theme_url('Base/js/app.js') }}"></script>
    @yield('footer')
</footer>
</body>
</html>
