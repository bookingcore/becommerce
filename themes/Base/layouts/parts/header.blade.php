@php $languages = \Modules\Language\Models\Language::getActive(); @endphp
<header class="header">
    @include('layouts.parts.header.topbar')
    <div class="header__content py-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3 header__content-left">
                    <a class="bc-logo" href="{{url('/')}}">
                        @if($logo_id = setting_item("logo_id"))
                            <?php $logo = get_file_url($logo_id,'full') ?>
                            <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                        @else
                            <span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>
                        @endif
                    </a>
                </div>
                <div class="col-md-6 header__content-center">
                    <div class="px-5">
                        @include('layouts.parts.header.search')
                    </div>
                </div>
                <div class="col-md-3 header__content-right">
                    <div class="header__actions"><a class="header__extra" href="#"><i class="icon-heart"></i><span><i>0</i></span></a>
                        <div class="bc-cart--mini">
                            @includeIf('order.cart.mini-cart')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation py-1">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="navigation__left">
                    @php generate_menu('primary') @endphp
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
                    <div class="bc-dropdown"><a href="#">US Dollar</a>
                        <ul class="bc-dropdown-menu">
                            <li><a href="#">Us Dollar</a></li>
                            <li><a href="#">Euro</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="bc-dropdown language"><a href="#"><img src="img/flag/en.png" alt="" />English</a>
                        <ul class="bc-dropdown-menu">
                            <li><a href="#"><img src="img/flag/germany.png" alt="" /> Germany</a></li>
                            <li><a href="#"><img src="img/flag/fr.png" alt="" /> France</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navigation--mobile">
        <div class="navigation__left"><a class="bc-logo" href="index.html"><img src="img/logo_light.png" alt="" /></a></div>
        <div class="navigation__right">
            <div class="header__actions">
                <div class="bc-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>
                    <div class="bc-cart__content">
                        <div class="bc-cart__items">
                            <div class="bc-product--cart-mobile">
                                <div class="bc-product__thumbnail"><a href="#"><img src="img/products/clothing/7.jpg" alt="" /></a></div>
                                <div class="bc-product__content"><a class="bc-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                </div>
                            </div>
                            <div class="bc-product--cart-mobile">
                                <div class="bc-product__thumbnail"><a href="#"><img src="img/products/clothing/5.jpg" alt="" /></a></div>
                                <div class="bc-product__content"><a class="bc-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                    <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                </div>
                            </div>
                        </div>
                        <div class="bc-cart__footer">
                            <h3>Sub Total:<strong>$59.99</strong></h3>
                            <figure><a class="btn" href="shopping-cart.html">View Cart</a><a class="btn" href="checkout.html">Checkout</a></figure>
                        </div>
                    </div>
                </div>
                <div class="bc-block--user-header">
                    <div class="bc-block__left"><a href="my-account.html"><i class="icon-user"></i></a></div>
                    <div class="bc-block__right"><a href="my-account.html">Login</a><a href="my-account.html">Register</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bc-search--mobile">
        <form class="bc-form--search-mobile" action="index.html" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something..." />
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>
