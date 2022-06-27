@extends('layouts.app')

@section('content')

<div class="store-header">
    <div class="store-information flex justify-between">
        <div class="flex items-center">
            <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="rounded-full w-24 mr-1">
            <div>
                <h3>{{$user->display_name}}</h3>
            </div>
        </div>
        <div class="flex items-center">
            <a class="rounded-sm bg-amber-300 px-5 py-3 text-center" href="#">{{__('Follow')}}</a>
        </div>
    </div>
</div>
<div class="bc-profile-content pt-5 pb-5">
    <div class="container">
        <form action="{{ route("store",['slug'=>$user->username]) }}" class="bc_form_filter">
            <div class="row">
                <div class="col-md-4">
                    @include("store.sidebar")
                </div>
                <div class="col-md-8">
                    <h3 class="mb-2">{{__("Hi, I'm :name",['name'=>$user->display_name])}}</h3>
                    <div class="mb-3">{!! $user->bio !!}</div>
                    <div class="div">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                            <div class="container-fluid">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link @if(empty($show_review)) active fw-bold pe-3 @endif" href="{{ route("store",['slug'=>$user->username]) }}">{{ __("Products") }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(!empty($show_review)) active fw-bold pe-3 @endif" href="{{ route("store.reviews",['slug'=>$user->username]) }}">{{ __("Reviews from guests") }}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        @if(empty($show_review))
                            @include('store.products')
                            <div class="bc-pagination">
                                {{$rows->withQueryString()->links()}}
                            </div>
                        @else
                            @include('store.reviews')
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
