@php $languages = \Modules\Language\Models\Language::getActive();
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
@endphp
<header id="masthead" class="header">
    @include('layouts.parts.header.topbar')
    <div class="container">
        <div class="header-wrap">
            <div class="site-branding">
                <div class="header__content-left">
                    <a class="axtronic-logo text-decoration-none" href="{{url('/')}}">
                        <img src="{{ theme_url('Axtronic/images/logo-white.svg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="site-navigation">
                <div class="site-main-menu">
                  @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
                </div>
            </div>
            <div class="site-member {{ Auth::id() ? 'is_login' : '' }}">
                <ul class="topbar-items nav">
                    @if(!Auth::id())
                        <li class="login-item">
                            <a href="#"  class="login user-contents">
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
                                <a class="wishlist-contents" href="#">
                                    <span class="group-icon-action">
                                        <i class="axtronic-icon-heart"></i>
                                        <span class="count">0</span>
                                    </span>
                                </a>
                            </div>
                        </li>
                        <li class="cart-item">
                            <div class="site-header-cart">
                                <a class="cart-contents" href="#">
                                    <span class="group-icon-action">
                                        <i class="axtronic-icon-shopping-cart"></i>
                                        <span class="count">0 </span>
                                    </span>
                                    <span class="account-content group-icon-content">
                                    <span class="sub-text">{{__('Total')}}</span>
                                    <span class="sub-title">{{__('$0.00')}}</span>
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
                        @include('layouts.parts.header.user')
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="header__content-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-end" >
                <div class="col-md-3">
                    @include('layouts.parts.header.category')
                </div>
                <div class="col-md-2">
                    <p> Find all you need here!</p>
                </div>
                <div class="col-md-7">
                    @include('layouts.parts.header.search')
                </div>
            </div>
        </div>
    </div>
</header>
