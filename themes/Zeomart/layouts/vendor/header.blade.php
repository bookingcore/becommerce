<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<header class="bg-white flex py-5">
    <div class="w-1/6 px-7">
        <a class="flex content-between" href="{{route('vendor.dashboard')}}">
            <img src="{{theme_url('zeomart/images/sidebar-control.svg')}}" alt="icon" class="mr-5">
            <span class="">
                @if($logo_id = setting_item("logo_id"))
                    <?php $logo = get_file_url($logo_id,'full') ?>
                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                @else
                    <span class="logo-text text-2xl font-bold">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>
                @endif
            </span>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="w-5/6">
        <div class="flex-grow-1 px-3">
            <form action="" method="get" class="relative ml-14">
                <input type="text" class="border border-gray-400 rounded-md p-4 text-base" placeholder="{{__('Search something')}}" name="s" value="{{request('s')}}">
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
