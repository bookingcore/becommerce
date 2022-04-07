<div class="site-cart-side side-wrap">
    <a href="#" class="close-cart-side close-side"><span class="screen-reader-text">Close</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">Shopping cart</span>
    </div>
    <div class="card-side-wrap-content side-wrap-content">
        <div class="axtronic-content-scroll">
            <div class="axtronic-card-content">

                {{--Danh sách wishlist trống--}}
                {{--<div class="axtronic-content-mid-notice">--}}
                {{--There are no products on the wishlist!--}}
                {{--</div>--}}

                <ul class="nav list-items list-product-items">
                    <li class="list-item product-item">
                        <div class="product-transition">
                            <div class="product-img-wrap">
                                <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                            </div>
                        </div>
                        <div class="product-caption">
                            <h2 class="product__title"><a href="#">Laptop ASUS VivoBook 15 A515EA</a></h2>
                            <div class="item-price">
                                <del aria-hidden="true"><bdi><span class="price-currency">$</span>101.47</bdi></del>
                                <ins aria-hidden="true"><bdi><span class="price-currency">$</span>101.47</bdi></ins>
                            </div>
                            <div class="item-time">March 17, 2022</div>
                        </div>
                        <a href="" class="remove remove_button">×</a>
                    </li>
                    <li class="list-item product-item">
                        <div class="product-transition">
                            <div class="product-img-wrap">
                                <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                            </div>
                        </div>
                        <div class="product-caption">
                            <h2 class="product__title"><a href="#">Apple MacBook Pro 13 Touch Bar M1 256GB 2019</a></h2>
                            <dl class="variation">
                                <dt class="variation-Vendor">Vendor:</dt>
                                <dd class="variation-Vendor"><p>AZ Tech Store</p>
                                </dd>
                            </dl>
                            <div class="item-price"><span class="quantity">1 x </span><bdi><span class="price-currency">$</span>172.58</bdi></div>
                        </div>
                        <a href="" class="remove remove_button">×</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="axtronic-card-bottom">
            <p class=" card-bottom-total">
                <strong>Subtotal:</strong> <span class="amount"><bdi><span class="price-currency">$</span>556.91</bdi></span>
            </p>
            <p class="card-bottom-button">
                <a class="button wc-forward" href="#">View cart</a>
                <a class="button checkout wc-forward" href="#">Checkout</a>
            </p>
        </div>
    </div>
</div>
<div class="cart-side-overlay side-overlay"></div>

<div class="site-user-side side-wrap">
    <a href="#" class="close-user-side close-side"><span class="screen-reader-text">Close</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">SIGN IN</span>
    </div>
    <div class="side-account-form-wrap">
        <div class="box-content">
            <div class="form-login active">
                <img class="img-label" src="{{ theme_url('Axtronic/images/login.svg') }}" alt="Login">
                @include('auth/login-form')
            </div>
            <div class="form-register">
                <img class="img-label" src="{{ theme_url('Axtronic/images/register.svg')}}" alt="Register">
                @include('auth/register-form')
                <a class="login-link" href="#">Already has an account</a>
            </div>
            <div class="form-lost-password">
                <img class="img-label" src="{{ theme_url('Axtronic/images/register.svg')}}" alt="Lost Password">
                <div class="woocommerce-notices-wrapper"></div>
                @include('auth/passwords/reset')
                <a class="login-link" href="#">Already has an account</a>
            </div>
        </div>
    </div>
</div>
<div class="user-side-overlay side-overlay"></div>

<div class="site-wishlist-side side-wrap">
    <a href="#" class="close-wishlist-side close-side"><span class="screen-reader-text">Close</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">WISHLIST</span>
    </div>
    <div class="wishlist-side-wrap-content side-wrap-content">
        <div class="axtronic-content-scroll">
            <div class="axtronic-wishlist-content content-loaded">

                {{--Danh sách wishlist trống--}}
                {{--<div class="axtronic-content-mid-notice">--}}
                    {{--There are no products on the wishlist!--}}
                {{--</div>--}}

                <ul class="nav list-items list-product-items">
                    <li class="list-item product-item">
                        <div class="product-transition">
                            <div class="product-img-wrap">
                                <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                            </div>
                        </div>
                        <div class="product-caption">
                            <h2 class="product__title"><a href="#">Laptop ASUS VivoBook 15 A515EA</a></h2>
                            <div class="item-price">
                                <del aria-hidden="true"><bdi><span class="price-currency">$</span>101.47</bdi></del>
                                <ins aria-hidden="true"><bdi><span class="price-currency">$</span>101.47</bdi></ins>
                            </div>
                            <div class="item-time">March 17, 2022</div>
                        </div>
                        <a href="" class="remove remove_button">×</a>
                    </li>
                    <li class="list-item product-item">
                        <div class="product-transition">
                            <div class="product-img-wrap">
                                <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                            </div>
                        </div>
                        <div class="product-caption">
                            <h2 class="product__title"><a href="#">Laptop ASUS VivoBook 15 A515EA</a></h2>
                            <div class="item-price"><bdi><span class="price-currency">$</span>172.58</bdi></div>
                            <div class="item-time">March 17, 2022</div>
                        </div>
                        <a href="" class="remove remove_button">×</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="axtronic-wishlist-bottom">
            <a class="button" href="#">Wishlist page</a>
        </div>
    </div>
</div>
<div class="wishlist-side-overlay side-overlay"></div>

<div class="site-menu-side side-wrap">
    <div class="axtronic-mobile-nav">
        <a href="#" class="close-menu-side"><i class="axtronic-icon-times"></i></a>
        <div class="menu-side-heading side-heading mobile-nav-tabs">
            <ul>
                <li class="mobile-tab-title mobile-pages-title active" data-menu="pages">
                    <span>Main Menu</span>
                </li>
                <li class="mobile-tab-title mobile-categories-title" data-menu="categories">
                    <span>Shop by Categories</span>
                </li>
            </ul>
        </div>
        <div class="mobile-pages-menu mobile-menu-tab active">
            @php generate_menu('primary',['class'=>'menu-mobile-page']) @endphp
        </div>
        <div class="mobile-categories-menu mobile-menu-tab">
            @php generate_menu('primary',['class'=>'menu-mobile-categories']) @endphp
        </div>
    </div>


</div>
<div class="menu-side-overlay side-overlay"></div>

<div class="footer-width-fixer">

</div>
