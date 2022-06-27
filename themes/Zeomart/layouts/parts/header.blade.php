<div class="zm-topbar">
    <div class="flex justify-between">
        <div class="left flex justify-start">
            <div class="item pr-5 pt-2.5 pb-2.5">
                <a href="#">
                    <img class="inline" src="/themes/zeomart/images/free_delivery.svg" alt="Free Delivery"> Free Delivery
                </a>
            </div>
            <div class="item pr-5 pt-2.5 pb-2.5">
                <a href="#">
                    Returns Policy
                </a>
            </div>
            <div class="item pr-5 pt-2.5 pb-2.5">
                <a href="#">
                    Free Express Shipping on orders $200!
                </a>
            </div>
        </div>
        <div class="right flex justify-start">
            @if(is_vendor_enable() and !is_vendor())
                <div class="item pl-5 pt-2.5 pb-2.5">
                    <a href="{{route('vendor.register')}}" class="text-white mt-1 d-inline-block">{{__('Sell on Us!')}}</a>
                </div>
            @endif
            <ul class="item pl-5 pt-2.5 pb-2.5 list-none">
                @include('layouts.parts.header.language-switcher')
            </ul>
            <ul class="item pl-5 pt-2.5 pb-2.5 list-none">
                @include('layouts.parts.header.currency-switcher')
            </ul>
            <div class="item pl-5 pt-2.5 pb-2.5">
                <a href="#">
                    Find a Store
                </a>
            </div>
            <div class="item pl-5 pt-2.5 pb-2.5 flex">
                Follow Us
                <ul class="social list-none flex">
                    <li class="ml-2 flex items-center">
                        <a href="#">
                            <img src="/themes/zeomart/images/icon-facebook.svg" alt="Facebook">
                        </a>
                    </li>
                    <li class="ml-2 flex items-center">
                        <a href="#">
                            <img src="/themes/zeomart/images/icon-twitter.svg" alt="Facebook">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="zm-header">

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
