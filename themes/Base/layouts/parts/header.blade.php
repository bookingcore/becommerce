@php $languages = \Modules\Language\Models\Language::getActive(); @endphp
<div class="ps-block--promotion-header bg--cover d-none" data-background="/themes/Base/img/promotions/header-promotion.jpg">
    <div class="container">
        <div class="ps-block__left">
            <h3>20%</h3>
            <figure>
                <p>Discount</p>
                <h4>For Books Of March</h4>
            </figure>
        </div>
        <div class="ps-block__center">
            <p>Enter Promotion<span>Sale2019</span></p>
        </div><a class="ps-btn ps-btn--sm" href="#">Shop now</a>
    </div>
</div>
<header class="header header--standard header--market-place-1" data-sticky="true">
    <div class="header__top">
        <div class="container">
            <div class="header__left">
                <p>{{ setting_item_with_lang('header_top') }}</p>
            </div>
            <div class="header__right">
                @php generate_menu('menu_header_top',['wrap_class' => 'header__top-links']) @endphp
            </div>
        </div>
    </div>
    <div class="header__content">
        <div class="container">
            <div class="header__content-left">
                @include('layouts.parts.header.department')
                <a class="ps-logo" href="{{url('/')}}">
                    @if($logo_id = setting_item("logo_id"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    @else
                        <span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>
                    @endif
                </a>
            </div>
            <div class="header__content-center">
                @include('layouts.parts.header.search')
            </div>
            <div class="header__content-right">
                <div class="header__actions"><a class="header__extra" href="#"><i class="icon-heart"></i><span><i>0</i></span></a>
                    <div class="ps-cart--mini">
                        @includeIf('order.cart.mini-cart')
                    </div>
                    @include('layouts.parts.header.user')
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container">
            <div class="navigation__left">
                @include('layouts.parts.header.department')
            </div>
            <div class="navigation__right">
                @php generate_menu('primary') @endphp
                <div class="ps-block--header-hotline inline">
                    <p><i class="icon-telephone"></i>Hotline:<strong> 1-800-234-5678</strong></p>
                </div>
            </div>
        </div>
    </nav>
</header>
<header class="header header--mobile" data-sticky="true">
    <div class="header__top">
        <div class="header__left">
            <p>Welcome to Martfury Online Shopping Store !</p>
        </div>
        <div class="header__right">
            <ul class="navigation__extra">
                <li><a href="#">Sell on Martfury</a></li>
                <li><a href="#">Tract your order</a></li>
                <li>
                    <div class="ps-dropdown"><a href="#">US Dollar</a>
                        <ul class="ps-dropdown-menu">
                            <li><a href="#">Us Dollar</a></li>
                            <li><a href="#">Euro</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="ps-dropdown language"><a href="#"><img src="img/flag/en.png" alt="" />English</a>
                        <ul class="ps-dropdown-menu">
                            <li><a href="#"><img src="img/flag/germany.png" alt="" /> Germany</a></li>
                            <li><a href="#"><img src="img/flag/fr.png" alt="" /> France</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navigation--mobile">
        <div class="navigation__left"><a class="ps-logo" href="index.html"><img src="img/logo_light.png" alt="" /></a></div>
        <div class="navigation__right">
            <div class="header__actions">
                <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>
                    <div class="ps-cart__content">
                        <div class="ps-cart__items">
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail"><a href="#"><img src="img/products/clothing/7.jpg" alt="" /></a></div>
                                <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                </div>
                            </div>
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail"><a href="#"><img src="img/products/clothing/5.jpg" alt="" /></a></div>
                                <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                    <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                </div>
                            </div>
                        </div>
                        <div class="ps-cart__footer">
                            <h3>Sub Total:<strong>$59.99</strong></h3>
                            <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
                        </div>
                    </div>
                </div>
                <div class="ps-block--user-header">
                    <div class="ps-block__left"><a href="my-account.html"><i class="icon-user"></i></a></div>
                    <div class="ps-block__right"><a href="my-account.html">Login</a><a href="my-account.html">Register</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="index.html" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something..." />
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>
