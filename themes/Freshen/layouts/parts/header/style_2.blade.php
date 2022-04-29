@include('layouts.parts.topbar')
<!-- header middle -->
<div class="header_middle pt25 pb25 dn-992 header_content {{ (isset($header_style) and $header_style=='2') ? " bgc-thm".$header_style : "" }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xl-3">
                <div class="header_top_logo_home1">
                    @if($logo_id = setting_item("freshen_logo_light"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <a href="{{ home_url() }}">
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                @include('layouts.parts.header.search')
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="log_fav_cart_widget">
                    <div class="wrapper">
                        <ul class="mb0 cart">
                            @if(!Auth::id())
                                <li class="list-inline-item text-end">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#login"><span class="flaticon-user icon {{ (isset($header_style) and $header_style == '2') ? 'text-white' : '' }}"></span></a>
                                </li>
                            @else
                                @include('layouts.parts.header.user')
                            @endif
                            <li class="list-inline-item bc-compare-count text-end">
                                <a href="#">
                                    <span class="flaticon-filter icon {{ (isset($header_style) and $header_style == '2') ? 'text-white' : '' }}">
                                        <span class="badge bgc-thm{{ $header_style ?? '1' }} number">
                                            {{ !empty(session('compare')) ? count(session('compare')) : "0" }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item text-end">
                                @if(Auth::user())
                                    <a href="{{route('user.wishList.index')}}">
                                        <span class="flaticon-heart icon {{ (isset($header_style) and $header_style == '2') ? 'text-white' : '' }}">
                                            <span class="badge bgc-thm{{ $header_style ?? '1' }} wishlist_count">{{ countWishlist() }}</span>
                                        </span>
                                    </a>
                                @else
                                    <a href="#login" data-bs-toggle="modal" data-target="#login">
                                        <span class="flaticon-heart icon {{ (isset($header_style) and $header_style == '2') ? 'text-white' : '' }}">
                                            <span class="badge bgc-thm">0</span>
                                        </span>
                                    </a>
                                @endif
                            </li>
                            <li class="list-inline-item bc-mini-cart text-end">
                                @includeIf('order.cart.mini-cart')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Header Nav -->
<header class="header-nav menu_style_home_one main-menu home{{ $header_style ?? setting_item('freshen_header_style') }}">
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
<div class="sign_up_modal modal fade" id="login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container p60">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __("Login") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __("Register") }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content container p0" id="myTabContent">
                    <div class="row mt30 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-lg-12">
                            @include("auth.login-form")
                        </div>
                    </div>
                    <div class="row mt30 tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-lg-12">
                            @include("auth.register-form")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
