@extends('layouts.app')

@section('content')
<div class="store-header">
    <div class="store-information bg-gray-500 px-4 sm:px-6 py-16 lg:px-8 flex items-center justify-between">
        <div class="flex items-center">
            <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="rounded-full w-24  mr-3">
            <div>
                <h1 class="text-white text-lg">{{$user->display_name}}</h1>
            </div>
        </div>
        <div class="flex items-center">
            <a class="rounded-lg bg-amber-300 px-16 py-3 text-center text-lg font-bold text-" href="#">{{__('Follow')}}</a>
        </div>
    </div>
</div>
<div class="">
    <div class="text-sm font-medium text-center text-gray-500  dark:text-gray-400 dark:border-gray-700 sticky top-0 ">
        <ul class="flex flex-wrap -mb-px">
            <li class="mr-2">
                <a href="#sectionProduct" class="inline-block p-4 pb-2 rounded-t-lg border-b-2 border-transparent text-gray-600 border-gray-300 hover:border-black hover:text-black active:text-black active">{{__("Product")}}</a>
            </li>
            <li class="mr-2">
                <a href="#sectionAbout" class="inline-block p-4 pb-2 rounded-t-lg border-b-2 border-transparent text-gray-600 border-gray-300 hover:border-black hover:text-black active:text-black" aria-current="page">{{__("About")}}</a>
            </li>
            <li class="mr-2">
                <a href="#sectionReviews" class="inline-block p-4 pb-2 rounded-t-lg border-b-2 border-transparent text-gray-600 border-gray-300 hover:border-black hover:text-black active:text-black">{{__('Reviews')}}</a>
            </li>
        </ul>
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
</div>

@endsection
