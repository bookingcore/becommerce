<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 {{$html_class ?? ''}}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/plugins/apexcharts-bundle/dist/apexcharts.css">
        <link rel="stylesheet" href="{{ theme_url('Base') }}/vendor/css/style.css">
        <link href="{{ theme_url('Base/dist/css/app.css') }}" rel="stylesheet">
        @include('layouts.parts.seo-meta')
        {!! \App\Helpers\Assets::css() !!}
        {!! \App\Helpers\Assets::js() !!}
        @yield('head')
    </head>
    <body class=" {{$body_class ?? ''}}">
        <main class="ps-main">
            @include('layouts.vendor.sidebar')
            <div class="ps-main__wrapper">
                @include('layouts.vendor.header')
            </div>
            @yield('content')
        </main>
    </body>
</html>
