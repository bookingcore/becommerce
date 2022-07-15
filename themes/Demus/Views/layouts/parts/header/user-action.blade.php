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
        @include('layouts.parts.header.notification')
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
