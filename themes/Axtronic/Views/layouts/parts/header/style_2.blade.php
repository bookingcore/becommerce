<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/15/2022
 * Time: 10:15 AM
 */
?>
@include('layouts.parts.header.topbar')
<div class="container">
    <div class="header-wrap">
        <div class="site-branding">
            <div class="header__content-left">
                @if(!empty($logo_header = setting_item('axtronic_logo_dark')))
                    <a class="axtronic-logo text-decoration-none" href="{{url('/')}}">
                        <img src="{{ get_file_url($logo_header,'full') }}" alt="">
                    </a>
                @endif
            </div>
        </div>
        <div class="site-navigation">
            @include('layouts.parts.header.search')
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
                                    <span class="sub-title">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span>
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
                                {{--<span class="account-content group-icon-content">--}}
                                {{--<span class="sub-text">{{__('Total')}}</span>--}}
                                {{--<span class="sub-title">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span>--}}
                                {{--</span>--}}
                            </a>
                        </div>
                    </li>
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
            <div class="col-md-7">
                <div class="site-main-menu">
                    @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
                </div>
            </div>
            <div class="col-md-2">
                <div class="icon-box-header">
                    <div class="icon-box-icon">
                       <span> <i aria-hidden="true" class="axtronic-icon- axtronic-icon-call-calling"></i></span>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="icon-box-title">
                            {{ setting_item('axtronic_hotline_text') }}
                        </h3>
                        <p class="icon-box-description">
                            {{ setting_item('axtronic_hotline_contact') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
