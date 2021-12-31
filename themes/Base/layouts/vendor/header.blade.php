<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<header class="header--dashboard">
    <div class="header__left">
        <h3>{{$page_title ?? __('Dashboard')}}</h3>
        <p>{{$page_subttile ?? ''}}</p>
    </div>
    <div class="header__center">
        <form class="ps-form--search-bar" action="{{route('vendor.product')}}" method="get">
            <input class="form-control" name="s" type="text" placeholder="{{__('Search product...')}}">
            <button><i class="icon-magnifier"></i></button>
        </form>
    </div>
    <div class="header__right"><a class="header__site-link" href="{{$user->getStoreUrl()}}"><span>{{__('View your store')}}</span><i class="icon-exit-right"></i></a></div>
</header>
