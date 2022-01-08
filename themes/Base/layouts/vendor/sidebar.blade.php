<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Home
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Orders
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Products
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Customers
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>
<div class="ps-main__sidebar">
    <div class="ps-sidebar">
        <div class="ps-sidebar__top">
            <div class="ps-block--user-wellcome">
                <div class="ps-block__left">
                    <div class="w-50px h-50px circle">
                        <img src="{{$user->avatar_url}}" alt="{{$user->display_name}}" class="object-cover">
                    </div>
                </div>
                <div class="ps-block__right">
                    <p>{{__('Hello')}},<a href="#">{{$user->display_name}}</a></p>
                </div>
                <div class="ps-block__action"><a title="{{__("To store page")}}" href="{{$user->getStoreUrl()}}"><i class="icon-exit-up "></i></a></div>
            </div>
            <div class="ps-block--earning-count"><small>{{__('Earning')}}</small>
                <h3>{{format_money($user->payable)}}</h3>
            </div>
        </div>
        <div class="ps-sidebar__content">
            <div class="ps-sidebar__center">
                <ul class="menu">
                   <li><a class="@if(in_array(request()->route()->getName(),['vendor.dashboard'])) active @endif" href="{{route('vendor.dashboard')}}"><i class="icon-home"></i>{{__('Dashboard')}}</a></li>
                   @foreach ($menus as $id=>$menu)
                        <li><a class="@if(\Modules\Vendor\VendorMenuManager::isActive($id,$menus)) active @endif" href="{{$menu['url'] ?? ''}}"><i class="{{$menu['icon'] ?? ''}}"></i>{{$menu['title'] ?? ''}}</a></li>
                   @endforeach
                    <li><a href="#"><i class="icon-exit"></i>{{__('Logout')}}</a></li>
                </ul>
            </div>
            <div class="ps-sidebar__footer">
                <div class="ps-copyright">
                    @include("global.logo")
                    <p>{{__('Powered by BeCommerce :version',['version'=>config('app.version')])}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
