@include('layouts.parts.topbar')
<!-- header middle -->
<div class="header_middle pt25 pb25 dn-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xl-3">
                <div class="header_top_logo_home1">
                    @if($logo_id = setting_item("freshen_logo_dark"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                            <a href="{{ home_url() }}">
                                <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                            </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-7 col-xl-7">
                @include('layouts.parts.header.search')
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="log_fav_cart_widget">
                    <div class="wrapper">
                        <ul class="mb0 cart">
                            <li class="list-inline-item">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#logInModal"><span class="flaticon-user icon"></span></a>
                            </li>
                            <li class="list-inline-item bc-compare-count">
                                <a href="#">
                                    <span class="flaticon-filter icon">
                                        <span class="badge bgc-thm number">
                                            {{ !empty(session('compare')) ? count(session('compare')) : "0" }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                @if(Auth::user())
                                    <a href="{{route('user.wishList.index')}}">
                                        <span class="flaticon-heart icon">
                                            <span class="badge bgc-thm wishlist_count">{{ countWishlist() }}</span>
                                        </span>
                                    </a>
                                @else
                                    <a href="#login" data-bs-toggle="modal" data-target="#login">
                                        <span class="flaticon-heart icon">
                                            <span class="badge bgc-thm">0</span>
                                        </span>
                                    </a>
                                @endif
                            </li>
                            @includeIf('order.cart.mini-cart')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Header Nav -->
<header class="header-nav menu_style_home_one main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
        <div class="container posr">
            <!-- Menu Toggle btn-->
            <div class="menu-toggle">
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a href="index.html" class="navbar_brand float-start dn-md">
                @if($logo_id = setting_item("logo_id"))
                    <?php $logo = get_file_url($logo_id,'full') ?>
                    <img class="logo2 img-fluid" src="{{$logo}}" alt="{{setting_item("site_title")}}">
                @endif
            </a>
            @include('layouts.parts.header.department')
            @php generate_menu('primary',['walker'=>'\\Themes\\Freshen\\Walkers\\MenuWalker','class'=>'ace-responsive-menu menu_list_custom_code wa pl330','id'=>'respMenu']) @endphp
            <ul id="respMenu2" class="ace-responsive-menu widget_menu_home2 wa" data-menu-style="horizontal">
                <li class="list-inline-item list_c">
                    <a href="tel:{{ setting_item('freshen_hotline_contact') }}">
                        <span class="flaticon-phone-call vam mr7"></span>
                        {{ __("HOTLINE") }}
                        <span class="text-thm fw400 dn-lg">{{ setting_item('freshen_hotline_contact') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Modal -->
