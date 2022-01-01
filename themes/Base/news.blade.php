@extends('layouts.app')
@section('content')
    <div class="ps-page--blog">
        <div class="container">
            <div class="ps-page__header">
                <h1>{{$header_title ?? __("News")}}</h1>
                <div class="ps-breadcrumb--2">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">{{__("Home")}}</a></li>
                        <li>{{$header_title ?? __("News")}}</li>
                    </ul>
                </div>
            </div>
            <div class="ps-blog--sidebar">
                <div class="ps-blog__left">
                    @if(count($rows))
                        @if(!request('page'))
                            @include('news.loop',['row'=>$rows[0]])
                        @endif
                        <div class="row">
                            @foreach($rows as $k=>$row)
                                <?php if(!request('page') && !$k) continue; ?>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ">
                                    @include('news.loop')
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="ps-pagination">
                        {{$rows->links()}}
                    </div>
                </div>
                <div class="ps-blog__right">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
