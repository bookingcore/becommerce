<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow align-items-center">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('vendor.dashboard')}}">
        <span class="d-flex align-items-center">
            <span class="w-30px h-30px circle me-2 d-block">
                <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="object-cover w-30px h-30px">
            </span>
            {{__("Store Dashboard")}}
        </span>
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="d-flex flex-shrink-0 mb-0">
        @include('layouts.parts.header.notification')
        @include('layouts.parts.header.user')
    </ul>
</header>
