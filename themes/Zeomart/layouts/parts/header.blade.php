<div class="zm-topbar m-auto max-w-7xl relative z-50">
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
            {!! setting_item_with_lang('zeomart_topbar_text_right') !!}
        </div>
    </div>
</div>
<div class="zm-header m-auto max-w-7xl mt-2 mb-2">
    <div class="flex items-center">
        <div class="logo w-1/6">
            <div class="text text-2xl font-bold">
                <a href="{{ home_url() }}">
                    {{ setting_item('zeomart_logo_text') }}
                </a>
            </div>
        </div>
        <div class="search w-4/6">
            @include('layouts.parts.header.search')
        </div>
        <div class="user-cart-wishlist flex justify-end w-2/6 text-base font-medium">
            @if(!Auth::user())
                <div class="ml-5">
                    <a href="#" class="flex items-center">
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 9.16667C8.82408 9.16667 9.62966 8.92233 10.3149 8.46442C11.0001 8.00662 11.5342 7.35587 11.8495 6.59452C12.1648 5.83316 12.2474 4.99538 12.0866 4.18712C11.9258 3.37888 11.529 2.63644 10.9462 2.05373C10.3636 1.47101 9.62116 1.07417 8.81291 0.913401C8.00458 0.752626 7.16683 0.835143 6.4055 1.1505C5.64412 1.46587 4.99338 1.99993 4.53554 2.68513C4.0777 3.37033 3.83333 4.17592 3.83333 5C3.83466 6.10467 4.27406 7.1637 5.05518 7.94482C5.8363 8.72592 6.89533 9.16533 8 9.16667ZM8 2.5C8.49441 2.5 8.97783 2.64663 9.38891 2.92133C9.80008 3.19603 10.1205 3.58648 10.3097 4.04329C10.4989 4.50011 10.5484 5.00277 10.452 5.48772C10.3555 5.97268 10.1174 6.41814 9.76775 6.76777C9.41816 7.1174 8.97266 7.3555 8.48775 7.45197C8.00275 7.54842 7.50008 7.49892 7.04325 7.3097C6.5865 7.12048 6.19603 6.80005 5.92132 6.38892C5.64662 5.97781 5.5 5.49446 5.5 5C5.5 4.33696 5.76339 3.70108 6.23223 3.23223C6.70108 2.76339 7.337 2.5 8 2.5ZM0.5 18.3333V15C0.501325 13.8953 0.940733 12.8363 1.72185 12.0552C2.50297 11.2741 3.56201 10.8347 4.66666 10.8333H11.3333C12.438 10.8347 13.497 11.2741 14.2782 12.0552C15.0592 12.8363 15.4987 13.8953 15.5 15V18.3333C15.5 18.5543 15.4122 18.7663 15.2559 18.9226C15.0997 19.0788 14.8877 19.1667 14.6667 19.1667C14.4457 19.1667 14.2337 19.0788 14.0774 18.9226C13.9212 18.7663 13.8333 18.5543 13.8333 18.3333V15C13.8333 14.337 13.5699 13.7011 13.1011 13.2322C12.6322 12.7634 11.9963 12.5 11.3333 12.5H4.66666C4.00362 12.5 3.36774 12.7634 2.8989 13.2322C2.43006 13.7011 2.16667 14.337 2.16667 15V18.3333C2.16667 18.5543 2.07887 18.7663 1.92259 18.9226C1.76631 19.0788 1.55435 19.1667 1.33333 19.1667C1.11232 19.1667 0.900358 19.0788 0.744075 18.9226C0.5878 18.7663 0.5 18.5543 0.5 18.3333Z" fill="#041E42"/>
                        </svg>
                        <span class="text pl-2 text-sm">{{__("My Account")}}</span>
                    </a>
                </div>
            @else
                @include('layouts.parts.header.user')
            @endif
            <div class="bc-compare-count ml-5 hidden">
                <a href="#" class="flex items-center">
                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.6234 0.553963C15.2175 0.553963 17.3198 2.68867 17.3198 5.67726C17.3198 11.6544 10.9157 15.07 8.78105 16.3508C6.6463 15.07 0.242188 11.6544 0.242188 5.67726C0.242188 2.68867 2.3769 0.553963 4.93853 0.553963C6.52675 0.553963 7.92712 1.40784 8.78105 2.26172C9.63485 1.40784 11.0352 0.553963 12.6234 0.553963ZM9.57855 13.8779C10.3307 13.4032 11.0096 12.931 11.6449 12.4255C14.1903 10.4018 15.612 8.19021 15.612 5.67726C15.612 3.6621 14.2996 2.26172 12.6234 2.26172C11.7046 2.26172 10.7107 2.74844 9.98835 3.46912L8.78105 4.67651L7.57361 3.46912C6.85123 2.74844 5.85731 2.26172 4.93853 2.26172C3.282 2.26172 1.94996 3.67576 1.94996 5.67726C1.94996 8.19111 3.37251 10.4018 5.91623 12.4255C6.55237 12.931 7.23121 13.4032 7.98348 13.8771C8.23875 14.0385 8.49155 14.193 8.78105 14.3655C9.07045 14.193 9.32325 14.0385 9.57855 13.8779Z" fill="#041E42"/>
                    </svg>
                    <span class="hidden absolute top-0 start-100 translate-middle badge rounded-pill bg-danger number">
                            {{ !empty(session('compare')) ? count(session('compare')) : "0" }}
                        </span>
                    <span class="text pl-2 text-sm">{{__("Compare")}}</span>
                </a>
            </div>
            <div class="bc-wishList-count ml-5">
                @if(Auth::user())
                    <a class="flex relative items-center" href="{{route('user.wishList.index')}}">
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6234 0.553963C15.2175 0.553963 17.3198 2.68867 17.3198 5.67726C17.3198 11.6544 10.9157 15.07 8.78105 16.3508C6.6463 15.07 0.242188 11.6544 0.242188 5.67726C0.242188 2.68867 2.3769 0.553963 4.93853 0.553963C6.52675 0.553963 7.92712 1.40784 8.78105 2.26172C9.63485 1.40784 11.0352 0.553963 12.6234 0.553963ZM9.57855 13.8779C10.3307 13.4032 11.0096 12.931 11.6449 12.4255C14.1903 10.4018 15.612 8.19021 15.612 5.67726C15.612 3.6621 14.2996 2.26172 12.6234 2.26172C11.7046 2.26172 10.7107 2.74844 9.98835 3.46912L8.78105 4.67651L7.57361 3.46912C6.85123 2.74844 5.85731 2.26172 4.93853 2.26172C3.282 2.26172 1.94996 3.67576 1.94996 5.67726C1.94996 8.19111 3.37251 10.4018 5.91623 12.4255C6.55237 12.931 7.23121 13.4032 7.98348 13.8771C8.23875 14.0385 8.49155 14.193 8.78105 14.3655C9.07045 14.193 9.32325 14.0385 9.57855 13.8779Z" fill="#041E42"/>
                        </svg>
                        <span class="hidden absolute top-0 start-100 translate-middle badge rounded-pill bg-danger number">
                            {{ countWishlist() }}
                        </span>
                        <span class="text pl-2 text-sm">{{__("WishList")}}</span>
                    </a>
                @else
                    <a href="#login" class="flex relative items-center" data-bs-toggle="modal" data-target="#login">
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6234 0.553963C15.2175 0.553963 17.3198 2.68867 17.3198 5.67726C17.3198 11.6544 10.9157 15.07 8.78105 16.3508C6.6463 15.07 0.242188 11.6544 0.242188 5.67726C0.242188 2.68867 2.3769 0.553963 4.93853 0.553963C6.52675 0.553963 7.92712 1.40784 8.78105 2.26172C9.63485 1.40784 11.0352 0.553963 12.6234 0.553963ZM9.57855 13.8779C10.3307 13.4032 11.0096 12.931 11.6449 12.4255C14.1903 10.4018 15.612 8.19021 15.612 5.67726C15.612 3.6621 14.2996 2.26172 12.6234 2.26172C11.7046 2.26172 10.7107 2.74844 9.98835 3.46912L8.78105 4.67651L7.57361 3.46912C6.85123 2.74844 5.85731 2.26172 4.93853 2.26172C3.282 2.26172 1.94996 3.67576 1.94996 5.67726C1.94996 8.19111 3.37251 10.4018 5.91623 12.4255C6.55237 12.931 7.23121 13.4032 7.98348 13.8771C8.23875 14.0385 8.49155 14.193 8.78105 14.3655C9.07045 14.193 9.32325 14.0385 9.57855 13.8779Z" fill="#041E42"/>
                        </svg>
                        <span class="hidden absolute top-0 start-100 translate-middle badge rounded-pill bg-danger number">
                            0
                        </span>
                        <span class="text pl-2 text-sm">{{__("WishList")}}</span>
                    </a>
                @endif
            </div>
            @include('order.cart.mini-cart')
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
                        @include('order.cart.mini-cart')
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav id="menu" class="stylehome1 bc-menu-mobile">
        @php generate_menu('primary',['walker'=>'\\Themes\\Freshen\\Walkers\\MenuMobileWalker','class'=>'main-menu-mobile','id'=>'freshen-menu-mobile']) @endphp
    </nav>
</div>
