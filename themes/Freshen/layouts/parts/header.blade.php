@include('layouts.parts.topbar')
<!-- header middle -->
<div class="header_middle pt25 pb25 dn-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xl-3">
                <div class="header_top_logo_home1">
                    @if($logo_id = setting_item("logo_id"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
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
            <div class="posr logo1">
                <div id="mega-menu">
                    <div class="btn-mega">
                        <span class="pre_line"></span>
                        <span class="ctr_title">ALL CATEGORIES</span>
                        <i class="fa fa-angle-down icon"></i>
                    </div>
                    <ul class="menu">
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-hot-sale"></span>
                                <span class="menu-title">Hot Offers</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-bell"></span>
                                <span class="menu-title">New Arrivals</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-discount"></span>
                                <span class="menu-title">Deals of The Day</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown" href="#">
                                <span class="menu-icn flaticon-harvest"></span>
                                <span class="menu-title">Fruits</span>
                            </a>
                            <div class="drop-menu">
                                <div class="one-third">
                                    <div class="cat-title">Fruits</div>
                                    <ul class="mb0">
                                        <li><a href="#">Apples & Bananas</a></li>
                                        <li><a href="#">Berries</a></li>
                                        <li><a href="#">Grapes</a></li>
                                        <li><a href="#">Mangoes</a></li>
                                        <li><a href="#">Melons</a></li>
                                        <li><a href="#">Pears</a></li>
                                        <li><a href="#">Anjeer (Figs)</a></li>
                                        <li><a href="#">Apricots</a></li>
                                    </ul>
                                    <div class="fresh-fruit">
                                        <p>Fresh Fruit</p>
                                        <h3 class="title">Fresh Summer With <br>Just $200.99</h3>
                                    </div>
                                    <div class="show"><a href="#">SHOP NOW</a></div>
                                </div>
                                <div class="one-third mt45">
                                    <ul class="mb0">
                                        <li><a href="#">Dates</a></li>
                                        <li><a href="#">Mixed Dried Fruits</a></li>
                                        <li><a href="#">Prunes</a></li>
                                        <li><a href="#">Raisins</a></li>
                                    </ul>
                                </div>
                                <div class="fruit_thumg"><img src="images/resource/menu-fruit.png" alt="menu-fruit.png"></div>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown" href="#">
                                <span class="menu-icn flaticon-vegetable"></span>
                                <span class="menu-title">Vegetables</span>
                            </a>
                            <div class="drop-menu">
                                <div class="one-third">
                                    <div class="cat-title">Fruits</div>
                                    <ul class="mb0">
                                        <li><a href="#">Apples & Bananas</a></li>
                                        <li><a href="#">Berries</a></li>
                                        <li><a href="#">Grapes</a></li>
                                        <li><a href="#">Mangoes</a></li>
                                        <li><a href="#">Melons</a></li>
                                        <li><a href="#">Pears</a></li>
                                        <li><a href="#">Anjeer (Figs)</a></li>
                                        <li><a href="#">Apricots</a></li>
                                    </ul>
                                    <div class="fresh-fruit">
                                        <p>Fresh Fruit</p>
                                        <h3 class="title">Fresh Summer With <br>Just $200.99</h3>
                                    </div>
                                    <div class="show"><a href="#">SHOP NOW</a></div>
                                </div>
                                <div class="one-third mt45">
                                    <ul class="mb0">
                                        <li><a href="#">Dates</a></li>
                                        <li><a href="#">Mixed Dried Fruits</a></li>
                                        <li><a href="#">Prunes</a></li>
                                        <li><a href="#">Raisins</a></li>
                                    </ul>
                                </div>
                                <div class="fruit_thumg"><img src="images/resource/menu-fruit.png" alt="menu-fruit.png"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-plastic-bottle"></span>
                                <span class="menu-title">Drinks</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown" href="#">
                                <span class="menu-icn flaticon-bread-1"></span>
                                <span class="menu-title">Bakery</span>
                            </a>
                            <div class="drop-menu">
                                <div class="one-third">
                                    <div class="cat-title">Fruits</div>
                                    <ul class="mb0">
                                        <li><a href="#">Apples & Bananas</a></li>
                                        <li><a href="#">Berries</a></li>
                                        <li><a href="#">Grapes</a></li>
                                        <li><a href="#">Mangoes</a></li>
                                        <li><a href="#">Melons</a></li>
                                        <li><a href="#">Pears</a></li>
                                        <li><a href="#">Anjeer (Figs)</a></li>
                                        <li><a href="#">Apricots</a></li>
                                    </ul>
                                    <div class="fresh-fruit">
                                        <p>Fresh Fruit</p>
                                        <h3 class="title">Fresh Summer With <br>Just $200.99</h3>
                                    </div>
                                    <div class="show"><a href="#">SHOP NOW</a></div>
                                </div>
                                <div class="one-third mt45">
                                    <ul class="mb0">
                                        <li><a href="#">Dates</a></li>
                                        <li><a href="#">Mixed Dried Fruits</a></li>
                                        <li><a href="#">Prunes</a></li>
                                        <li><a href="#">Raisins</a></li>
                                    </ul>
                                </div>
                                <div class="fruit_thumg"><img src="images/resource/menu-fruit.png" alt="menu-fruit.png"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-boiled-egg"></span>
                                <span class="menu-title">Butter & Egges</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown" href="#">
                                <span class="menu-icn flaticon-milk-1"></span>
                                <span class="menu-title">Milks & Creams</span>
                            </a>
                            <div class="drop-menu">
                                <div class="one-third">
                                    <div class="cat-title">Fruits</div>
                                    <ul class="mb0">
                                        <li><a href="#">Apples & Bananas</a></li>
                                        <li><a href="#">Berries</a></li>
                                        <li><a href="#">Grapes</a></li>
                                        <li><a href="#">Mangoes</a></li>
                                        <li><a href="#">Melons</a></li>
                                        <li><a href="#">Pears</a></li>
                                        <li><a href="#">Anjeer (Figs)</a></li>
                                        <li><a href="#">Apricots</a></li>
                                    </ul>
                                    <div class="fresh-fruit">
                                        <p>Fresh Fruit</p>
                                        <h3 class="title">Fresh Summer With <br>Just $200.99</h3>
                                    </div>
                                    <div class="show"><a href="#">SHOP NOW</a></div>
                                </div>
                                <div class="one-third mt45">
                                    <ul class="mb0">
                                        <li><a href="#">Dates</a></li>
                                        <li><a href="#">Mixed Dried Fruits</a></li>
                                        <li><a href="#">Prunes</a></li>
                                        <li><a href="#">Raisins</a></li>
                                    </ul>
                                </div>
                                <div class="fruit_thumg"><img src="images/resource/menu-fruit.png" alt="menu-fruit.png"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-meat"></span>
                                <span class="menu-title">Meats</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-icn flaticon-fish"></span>
                                <span class="menu-title">Fish</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
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
