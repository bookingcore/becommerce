<ul class="topbar-items nav">
    @if(!Auth::id())
        <li class="login-item">
            <a href="#" class="login user-contents">
      <span class="account-user group-icon-action">
      <i aria-hidden="true" class="axtronic-icon-user"></i>
      </span>
                <span class="account-content group-icon-content">
      <span class="sub-text">{{__('Sign in')}}</span>
      <span class="sub-title">{{__('Account')}}</span>
      </span>
            </a>
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
        <li class="cart-item">
            <div class="site-header-cart">
                <a class="cart-contents" href="#">
         <span class="group-icon-action">
         <i class="axtronic-icon-shopping-cart"></i>
         <span class="count">{{\Modules\Order\Helpers\CartManager::count()}}</span>
         </span>
                    <span class="account-content group-icon-content">
         <span class="sub-text">{{__('Total')}}</span>
         <span
             class="sub-title">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span>
         </span>
                </a>
            </div>
        </li>
        <li class="site-header-menu">
            <a href="#" class="menu-mobile-nav-button">
      <span class="group-icon-action">
      <i class="axtronic-icon-bars"></i>
      </span>
            </a>
        </li>
    @else
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
        @include('layouts.parts.header.notification')
        <li class="cart-item">
            <div class="site-header-cart">
                <a class="cart-contents" href="#">
         <span class="group-icon-action">
         <i class="axtronic-icon-shopping-cart"></i>
         <span class="count">{{\Modules\Order\Helpers\CartManager::count()}}</span>
         </span>
                    <span class="account-content group-icon-content">
         <span class="sub-text">{{__('Total')}}</span>
         <span
             class="sub-title">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span>
         </span>
                </a>
            </div>
        </li>
    @endif
</ul>
