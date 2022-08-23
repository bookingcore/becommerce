@extends('layouts.app')
@section('content')
    <div class="bc-page-blog py-4">
        <div class="bc-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$header_title ?? __("News")}}</a></li>
                </ol>
                <h1>{{ setting_item('news_page_list_title') }}</h1>
            </div>
        </div>
        <div class="container">

            <div class="row g-4 g-xl-5">
                @if(setting_item('demus_news_layout') == 'no-sidebar')
                    <div class="col-12">
                        @if(count($rows))
                            @php
                                switch (setting_item('demus_news_item_layout') ?? '2'){
                                   case '1': $classPosition = "col-lg-12 col-md-6"; break;
                                   case '2': $classPosition = "col-md-6 col-12"; break;
                                   case '3': $classPosition = "col-lg-4 col-md-6 col-12"; break;
                                   case '4': $classPosition = "col-lg-3 col-md-6  col-12"; break;
                                   case '6': $classPosition = "col-lg-2 col-md-6  col-12"; break;
                                   default: $classPosition = "col-lg-12";
                               }
                            @endphp
                            <div class="row">
                                @foreach($rows as $k=>$row)
                                    <div class="col {{$classPosition}}">
                                        @include('news.loop')
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div class="alert alert-warning">{{__("No posts found")}}</div>
                        @endif
                        <div class="bc-pagination">
                            {{$rows->withQueryString()->links()}}
                        </div>
                    </div>
                @else
                    <div class="col-12 col-xl-9 main-blog__inner @if(setting_item('demus_news_layout')== 'left-sidebar') order-1 @endif">
                        @if(count($rows))
                            @php
                                switch (setting_item('demus_news_item_layout') ?? '2'){
                                   case '1': $classPosition = "col-lg-12 col-md-6"; break;
                                   case '2': $classPosition = "col-md-6 col-12"; break;
                                   case '3': $classPosition = "col-lg-4 col-md-6 col-12"; break;
                                   case '4': $classPosition = "col-lg-3 col-md-6  col-12"; break;
                                   case '6': $classPosition = "col-lg-2 col-md-6  col-12"; break;
                                   default: $classPosition = "col-lg-12";
                               }
                            @endphp
                            <div class="row">
                                @foreach($rows as $k=>$row)
                                    <div class="col {{$classPosition}}">
                                        @include('news.loop')
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div class="alert alert-warning">{{__("No posts found")}}</div>
                        @endif
                        <div class="bc-pagination">
                            {{$rows->withQueryString()->links()}}
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 ">
                        @include('news.sidebar')
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
