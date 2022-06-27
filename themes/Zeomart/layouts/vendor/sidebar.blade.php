<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<nav id="sidebarMenu" class="pt-14 ">
    <div class="">
        <ul class="font-medium">
            <li class="nav-item mb-2"><a class="transition duration-200 px-5 py-4 block  text-base rounded-[16px] hover:bg-amber-400 @if(in_array(request()->route()->getName(),['vendor.dashboard'])) active bg-amber-400 @endif" href="{{route('vendor.dashboard')}}"><i class="pr-4 fa fa-desktop"></i> {{__('Dashboard')}}</a></li>
            @foreach ($menus as $id=>$menu)
                <li class="nav-item  mb-2"><a class="transition duration-200 px-5 py-4 block  text-base rounded-[16px] hover:bg-amber-400 @if(\Modules\Vendor\VendorMenuManager::isActive($id,$menus)) active bg-amber-400 @endif" href="{{$menu['url'] ?? ''}}"><i class="pr-4 {{$menu['icon'] ?? ''}}"></i> {{$menu['title'] ?? ''}}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
