@extends('layouts.app')

@section('content')
<div class="bc-profile-content pt-5 pb-5">
    <div class="container">
        <form action="{{ route("user.frond.profile",['id'=>$user->id]) }}" class="bc_form_filter">
            <div class="row">
                <div class="col-md-4">
                    @include("user.profile.sidebar")
                </div>
                <div class="col-md-8">
                    <h3 class="mb-2">{{__("Hi, I'm :name",['name'=>$user->getDisplayName()])}}</h3>
                    <div class="mb-3">{!! $user->bio !!}</div>
                    <div class="div">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                            <div class="container-fluid">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link @if(empty($show_review)) active fw-bold pe-3 @endif" href="{{ route("user.frond.profile",['id'=>$user->id]) }}">{{ __("Products") }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(!empty($show_review)) active fw-bold pe-3 @endif" href="{{ route("user.frond.profile.reviews",['id'=>$user->id]) }}">{{ __("Reviews from guests") }}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        @if(empty($show_review))
                            @include('user.profile.services')
                            <div class="bc-pagination">
                                {{$rows->links()}}
                            </div>
                        @else
                            @include('user.profile.reviews')
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
