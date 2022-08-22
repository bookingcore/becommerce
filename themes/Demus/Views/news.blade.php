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
