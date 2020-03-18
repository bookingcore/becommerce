@extends('layouts.app')
@section('head')
    <link href="{{ asset('module/news/css/news.css?_ver='.config('app.version')) }}" rel="stylesheet">
    <link href="{{ asset('css/app.css?_ver='.config('app.version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}" />
@endsection
@section('content')
    <div class="bravo-news">
        @php
            $title_page = setting_item("news_page_list_title");
            if(!empty($custom_title_page)){
                $title_page = $custom_title_page;
            }
        @endphp

        <div class="blog-layout-content-sidebar">
            <div class="bravo_content site-content">
                <div class="container">
                    <div class="row">
                        <div class="content-area col-md-9 col-sm-12 col-xs-12">
                            @include('News::frontend.layouts.details.news-detail')
                        </div>
                        <div class="widgets-area primary-sidebar col-md-3 col-sm-12 col-xs-12  blog-sidebar">
                            @include('News::frontend.layouts.details.news-sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


