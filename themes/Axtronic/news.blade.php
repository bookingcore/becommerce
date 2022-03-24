@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb" class="axtronic-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </div>
    </nav>
    <div class="axtronic-page-blog">
        <div class="container">
            <div class="row b-5">
                <div class="col-lg-8">
                    @if(count($rows))
                        @foreach($rows as $k=>$row)
                            @include('news.loop')
                        @endforeach
                    @else
                        <div class="alert alert-warning">{{__("No posts found")}}</div>
                    @endif
                    <div class="axtronic-pagination">
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
