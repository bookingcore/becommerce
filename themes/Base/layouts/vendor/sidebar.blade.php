<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky p-3">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link @if(in_array(request()->route()->getName(),['vendor.dashboard'])) active @endif" href="{{route('vendor.dashboard')}}"><i class="icon-home"></i>{{__('Dashboard')}}</a></li>
            @foreach ($menus as $id=>$menu)
                <li class="nav-item"><a class="nav-link @if(\Modules\Vendor\VendorMenuManager::isActive($id,$menus)) active @endif" href="{{$menu['url'] ?? ''}}"><i class="{{$menu['icon'] ?? ''}}"></i>{{$menu['title'] ?? ''}}</a></li>
            @endforeach
            <li class="nav-item"><a class="nav-link" href="#"><i class="icon-exit"></i>{{__('Logout')}}</a></li>
        </ul>
    </div>
</nav>
