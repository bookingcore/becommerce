<?php $header_style = isset($header_style) && !empty($header_style) ? $header_style : '1'; ?>
@include("layouts.parts.header.style_".$header_style)
<!-- Main Header Nav For Mobile -->
<div id="page" class="stylehome1 h0 bc-main-header-mobile">
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
