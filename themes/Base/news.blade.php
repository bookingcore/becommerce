@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="bc-page--blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(count($rows))
                        @foreach($rows as $k=>$row)
                            @include('news.loop')
                        @endforeach
                    @else
                        <div class="alert alert-warning">{{__("No posts found")}}</div>
                    @endif
                    <div class="bc-pagination">
                        {{$rows->links()}}
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
