<header class="header-nav menu_style_home_one home2 bgc-thm main-menu">
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
            @if($logo_id = setting_item("freshen_logo_light"))
                <?php $logo = get_file_url($logo_id,'full') ?>
                <a href="{{ home_url() }}" class="navbar_brand float-start dn-md mt5-lg">
                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                </a>
            @endif
            <!-- Responsive Menu Structure-->
            @php generate_menu('primary',['walker'=>'\\Themes\\Freshen\\Walkers\\MenuWalker','class'=>'ace-responsive-menu menu_list_custom_code text-center wa','id'=>'respMenu']) @endphp
            <ul id="respMenu2" class="ace-responsive-menu widget_menu_home2 home4_style wa" data-menu-style="horizontal">
                <li class="list-inline-item home4_style list_c">
                    <a href="tel:{{ setting_item('freshen_hotline_contact') }}">
                        <span class="flaticon-phone-call vam mr7"></span> {{ __("HOTLINE") }} <span class="fw400 dn-lg">{{ setting_item('freshen_hotline_contact') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="header_middle home2 pt15 pb15 dn-992 bgc-thm1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('layouts.parts.header.department')
            </div>
            <div class="col-lg-7 col-xl-6">
                @include('layouts.parts.header.search')
            </div>
            <div class="col-lg-2 col-xl-3">
                <div class="log_fav_cart_widget home4_style">
                    <div class="wrapper">
                        <ul class="mb0 cart">
                            @if(!Auth::id())
                                <li class="list-inline-item mr15-lg"><a href="#" data-bs-toggle="modal" data-bs-target="#logInModal"><span class="flaticon-user icon text-white"></span> <span class="price text-white ml5 dn-lg">{{ __("LOGIN") }}</span></a></li>
                            @else
                                @include('layouts.parts.header.user')
                            @endif
                            @if(Auth::user())
                                <li class="list-inline-item mr15-lg"><a href="#"><span class="flaticon-heart icon text-white"><span class="badge bgc-white">2</span></span> <span class="price text-white ml5 dn-lg">{{ __("WISHLIST") }}</span></a></li>
                            @else
                                <li class="list-inline-item mr15-lg"><a href="#" data-bs-toggle="modal" data-bs-target="#logInModal"><span class="flaticon-heart icon text-white"><span class="badge bgc-white">0</span></span> <span class="price text-white ml5 dn-lg">{{ __("WISHLIST") }}</span></a></li>
                            @endif
                            <li class="list-inline-item">
                                @includeIf('order.cart.mini-cart')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
