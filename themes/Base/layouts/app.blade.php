<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ theme_url('base/dist/css/app.css') }}" rel="stylesheet">
        @include('layouts.parts.seo-meta')
        {!! \App\Helpers\Assets::css() !!}
        {!! \App\Helpers\Assets::js() !!}
        @yield('head')
    </head>
    <body class="d-flex flex-column h-100 {{$body_class ?? ''}}">
        <main class="flex-shrink-0">
            @include('layouts.parts.header')
            @yield('content')

        </main>
        <footer class="footer mt-auto py-3 bg-light">
            @include('layouts.parts.footer')

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
            <link href="{{ theme_url('base/js/app.js') }}" rel="stylesheet">
            @yield('footer')
        </footer>
    </body>
</html>
