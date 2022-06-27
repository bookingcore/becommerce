<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<header class="bg-white flex">
    <div class="w-1/6">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('vendor.dashboard')}}">
            <span class="d-flex align-items-center">
                <span class="w-30px h-30px circle me-2 d-block">
                    <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="object-cover w-30px h-30px">
                </span>
                {{$user->display_name  ? $user->display_name : __("Store Dashboard")}}
            </span>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="w-5/6">
        <div class="flex-grow-1 px-3">
            <form action="" method="get" class="relative">
                <input type="text" placeholder="{{__('Search something')}}" name="s" value="{{request('s')}}">
                <button class="absolute top-0 right-0 p-3"></button>
            </form>
            <a href="{{url('/')}}" class="btn btn-outline-light me-3"><i class="fa fa-home"></i> {{__("To homepage")}}</a>
            <a href="{{$user->getStoreUrl()}}" class="btn btn-light"><i class="fa fa-shopping-basket"></i> {{__("View my store")}}</a>
        </div>
        <ul class="d-flex flex-shrink-0 mb-0  list-unstyled " style="display: none">
            @include('layouts.parts.header.notification')
            @include('layouts.parts.header.user')
        </ul>
    </div>
</header>
