<?php

$checkNotify = \Modules\Core\Models\NotificationPush::query();
if(is_admin()){
    $checkNotify->where(function($query){
        $query->where('data', 'LIKE', '%"for_admin":1%');
        $query->orWhere('notifiable_id', Auth::id());
    });
}else{
    $checkNotify->where('data', 'LIKE', '%"for_admin":0%');
    $checkNotify->where('notifiable_id', Auth::id());
}
$notifications = $checkNotify->orderBy('created_at', 'desc')->limit(5)->get();
$countUnread = $checkNotify->where('read_at', null)->count();
?>

<ul class="topbar-items nav">
    <li class="search-item">
        <div class="site-header-search">
            <a class="search-contents" href="#">
                 <span class="group-icon-action">
                    <i class="axtronic-icon-search"></i>
                 </span>
            </a>
            @include('layouts.parts.header.search')
        </div>
    </li>
    @if(!Auth::id())
        <li class="login-item">
            <a href="#" class="login user-contents">
                <span class="account-user group-icon-action ">
                    <i aria-hidden="true" class="axtronic-icon-user"></i>
                </span>
            </a>
        </li>
    @else
        <li class="notifications-item">
            <div class="site-header-notifications">
                <a class="notifications-contents is_login" href="#">
                    <span class="group-icon-action">
                        <i class="axtronic-icon-envelope"></i>
                        <span class="count">{{$countUnread}}</span>
                    </span>
                </a>
            </div>
        </li>
        <li class="wishlist-item">
            <div class="site-header-wishlist">
                <a class="wishlist-contents" href="{{route('user.wishList.index')}}">
                     <span class="group-icon-action">
                         <i class="axtronic-icon-heart"></i>
                         <span class="count">{{ countWishlist() }}</span>
                     </span>
                </a>
            </div>
        </li>
    @endif
        <li class="cart-item">
            <div class="site-header-cart">
                <a class="cart-contents" href="#">
                 <span class="group-icon-action">
                     <i class="axtronic-icon-shopping-cart"></i>
                     <span class="count">{{\Modules\Order\Helpers\CartManager::count()}}</span>
                 </span>
                </a>
            </div>
        </li>
        <li class="site-header-menu d-block d-lg-none">
            <a href="#" class="menu-mobile-nav-button">
                <span class="group-icon-action">
                    <i class="axtronic-icon-bars"></i>
                </span>
            </a>
        </li>
</ul>
