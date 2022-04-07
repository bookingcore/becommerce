@extends('layouts.app')
@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <h2 class="breadcrumb_title">{{$header_title ?? __("News")}}</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$header_title}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog_post_container pb80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    @if(count($rows))
                        <div class="row">
                            @foreach($rows as $k=>$row)
                                <div class="col-md-6 col-xl-4">
                                    @include('news.loop')
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">{{__("No posts found")}}</div>
                    @endif
                    <div class="bc-pagination">
                        {{$rows->links()}}
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
