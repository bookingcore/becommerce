@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="bc-page--blog">
        <div class="container">
            <div class="px-4 py-5 my-5 text-center">
                <h1 class="display-5 fw-bold">{{$header_title ?? __("News")}}</h1>
            </div>
            <div class="row">
                <div class="col-md-9">
                    @if(count($rows))
                        <div class="row">
                            @foreach($rows as $k=>$row)
                                <div class="col-sm-4 mb-3">
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
                <div class="col-md-3">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
