@extends('layouts.app')
@section('content')
    <div class="bc-page-blog py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="news-heading">
                        <h1 class="display-5 fw-bold news-title">{{$header_title ?? __("News")}}</h1>
                        <div class="news-description">
                            {{$news_description ?? ''}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 pb-5">
                <div class="col-lg-8">
                    @if(count($rows))
                        @foreach($rows as $k=>$row)
                            @include('news.loop')
                        @endforeach
                    @else
                        <div class="alert alert-warning">{{__("No posts found")}}</div>
                    @endif
                    <div class="bc-pagination">
                        {{$rows->withQueryString()->links()}}
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
