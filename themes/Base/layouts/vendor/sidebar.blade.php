<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
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
                    <p>&copy;{{__('2020 BeCommerce marketplace')}}. <br> {{__('All rights reversed.')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
