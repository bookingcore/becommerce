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
    <div class="w-5/6 flex justify-between	">
        <div class="grow">
            <div class="w-1/3">
                <form action="" method="get" class="relative ml-14">
                    <input type="text" class="border border-gray-200 w-full rounded-md px-5 py-3 text-base" placeholder="{{__('Search something')}}" name="s" value="{{request('s')}}">
                    <button class="absolute top-0 right-0 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <ul class="shrink-0 flex content-between gap-2.5 px-7 items-center">
            <a href="{{$user->getStoreUrl()}}" title="{{__("View store")}}" class="dropdown-item rounded-[16px] w-[50px] h-[50px] hover:bg-[#F3F5F6] transition duration-200" >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </a>
            @include('layouts.parts.header.notification')
            @include('layouts.parts.header.user')
        </ul>
    </div>
</header>
