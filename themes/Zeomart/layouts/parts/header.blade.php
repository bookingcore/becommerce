<div class="zm-topbar m-auto max-w-7xl">
    <div class="flex justify-between">
        <div class="left flex justify-start">
            {!! setting_item_with_lang('zeomart_topbar_text_left') !!}
        </div>
        <div class="right flex justify-start">
            @if(is_vendor_enable() and !is_vendor())
                <div class="item pl-5 pt-2.5 pb-2.5">
                    <a href="{{route('vendor.register')}}" class="text-white mt-1 d-inline-block">{{__('Sell on Us!')}}</a>
                </div>
            @endif
            <div class="item pl-5 pt-2.5 pb-2.5 list-none">
                @include('layouts.parts.header.language-switcher')
            </div>
            <div class="item pl-5 pt-2.5 pb-2.5 list-none">
                @include('layouts.parts.header.currency-switcher')
            </div>
            <div class="item pl-5 pt-2.5 pb-2.5">
                <a href="#">
                    Find a Store
                </a>
            </div>
            {!! setting_item_with_lang('zeomart_topbar_text_right') !!}
        </div>
    </div>
</div>
<div class="zm-header m-auto max-w-7xl">
    <div class="flex">
        <div class="logo w-1/6">
            <div class="text text-2xl font-bold">
                {{ setting_item('zeomart_logo_text') }}
            </div>
        </div>
        <div class="search w-4/6">
            @include('layouts.parts.header.search')
        </div>
        <div class="user-cart-wishlist flex justify-end w-2/6 text-base font-medium">
            @if(!Auth::user())
                <div class="">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#login">
                        <span class="flaticon-user icon {{ (isset($header_style) and $header_style == '2') ? 'text-white' : '' }}"></span>
                    </a>
                </div>
            @else
                @include('layouts.parts.header.user')
            @endif
            <div class="bc-compare-count mr-2">
                <a  class="relative">
                    <i class="fa fa-bar-chart fa-2x c-main"></i>
                    <span class="absolute top-0 start-100 translate-middle badge rounded-pill number">
                        {{ !empty(session('compare')) ? count(session('compare')) : "0" }}
                    </span>
                </a>
            </div>
            <div class="bc-wishList-count mr-2">
                @if(Auth::user())
                    <a class="flex relative" href="{{route('user.wishList.index')}}">
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6234 0.553963C15.2175 0.553963 17.3198 2.68867 17.3198 5.67726C17.3198 11.6544 10.9157 15.07 8.78105 16.3508C6.6463 15.07 0.242188 11.6544 0.242188 5.67726C0.242188 2.68867 2.3769 0.553963 4.93853 0.553963C6.52675 0.553963 7.92712 1.40784 8.78105 2.26172C9.63485 1.40784 11.0352 0.553963 12.6234 0.553963ZM9.57855 13.8779C10.3307 13.4032 11.0096 12.931 11.6449 12.4255C14.1903 10.4018 15.612 8.19021 15.612 5.67726C15.612 3.6621 14.2996 2.26172 12.6234 2.26172C11.7046 2.26172 10.7107 2.74844 9.98835 3.46912L8.78105 4.67651L7.57361 3.46912C6.85123 2.74844 5.85731 2.26172 4.93853 2.26172C3.282 2.26172 1.94996 3.67576 1.94996 5.67726C1.94996 8.19111 3.37251 10.4018 5.91623 12.4255C6.55237 12.931 7.23121 13.4032 7.98348 13.8771C8.23875 14.0385 8.49155 14.193 8.78105 14.3655C9.07045 14.193 9.32325 14.0385 9.57855 13.8779Z" fill="#041E42"/>
                        </svg>
                        <span class="text">{{__("WishList")}}</span>
                        <span class="absolute top-0 start-100 translate-middle badge rounded-pill bg-danger number">
                            {{ countWishlist() }}
                        </span>
                    </a>
                @else
                    <a href="#login" class="flex" data-bs-toggle="modal" data-target="#login">
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6234 0.553963C15.2175 0.553963 17.3198 2.68867 17.3198 5.67726C17.3198 11.6544 10.9157 15.07 8.78105 16.3508C6.6463 15.07 0.242188 11.6544 0.242188 5.67726C0.242188 2.68867 2.3769 0.553963 4.93853 0.553963C6.52675 0.553963 7.92712 1.40784 8.78105 2.26172C9.63485 1.40784 11.0352 0.553963 12.6234 0.553963ZM9.57855 13.8779C10.3307 13.4032 11.0096 12.931 11.6449 12.4255C14.1903 10.4018 15.612 8.19021 15.612 5.67726C15.612 3.6621 14.2996 2.26172 12.6234 2.26172C11.7046 2.26172 10.7107 2.74844 9.98835 3.46912L8.78105 4.67651L7.57361 3.46912C6.85123 2.74844 5.85731 2.26172 4.93853 2.26172C3.282 2.26172 1.94996 3.67576 1.94996 5.67726C1.94996 8.19111 3.37251 10.4018 5.91623 12.4255C6.55237 12.931 7.23121 13.4032 7.98348 13.8771C8.23875 14.0385 8.49155 14.193 8.78105 14.3655C9.07045 14.193 9.32325 14.0385 9.57855 13.8779Z" fill="#041E42"/>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <span class="wishlist_count">0</span>
                            <span class="visually-hidden">{{__("WishList")}}</span>
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Main Header Nav For Mobile -->
<div id="page" class="stylehome1 h0 bc-main-header-mobile " style="display:none">
    <div class="mobile-menu">
        <div class="header stylehome1">
            <div class="mobile_menu_bar">
                <a class="menubar" href="#menu"><span></span></a>
            </div>
            <div class="mobile_menu_main_logo">
                @if($logo_id = setting_item("freshen_logo_dark"))
                    <?php $logo = get_file_url($logo_id,'full') ?>
                    <a href="{{ home_url() }}">
                        <img class="nav_logo_img img-fluid mt5" src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    </a>
                @endif
            </div>
            <div class="mobile_menu_widget_icons">
                <ul class="cart mt15">
                    @if(!Auth::user())
                        <li class="list-inline-item text-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#login"><span class="flaticon-user icon fs-18 {{ (isset($header_style) and $header_style == '2') ? 'text-white' : '' }}"></span></a>
                        </li>
                    @else
                        @include('layouts.parts.header.user',['is_use_mobile'=>1])
                    @endif
                    <li class="list-inline-item ms-3">
                        @includeIf('order.cart.mini-cart')
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav id="menu" class="stylehome1 bc-menu-mobile">
        @php generate_menu('primary',['walker'=>'\\Themes\\Freshen\\Walkers\\MenuMobileWalker','class'=>'main-menu-mobile','id'=>'freshen-menu-mobile']) @endphp
    </nav>
</div>
