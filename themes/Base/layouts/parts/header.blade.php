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
                <p>Welcome to Martfury Online Shopping Store !</p>
            </div>
            <div class="header__right">
                <ul class="header__top-links">
                    <li><a href="#">Store Location</a></li>
                    <li><a href="#">Track Your Order</a></li>
                    <li>
                        <div class="ps-dropdown"><a href="#">US Dollar</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#">Us Dollar</a></li>
                                <li><a href="#">Euro</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="ps-dropdown language"><a href="#"><img src="img/flag/en.png" alt="">English</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#"><img src="img/flag/germany.png" alt=""> Germany</a></li>
                                <li><a href="#"><img src="img/flag/fr.png" alt=""> France</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header__content">
        <div class="container">
            <div class="header__content-left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span>Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <li><a href="#.html">Hot Promotions</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a href="#">Consumer Electronic</a><span class="sub-toggle"></span>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Electronic<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#.html">Home Audio &amp; Theathers</a>
                                            </li>
                                            <li><a href="#.html">TV &amp; Videos</a>
                                            </li>
                                            <li><a href="#.html">Camera, Photos &amp; Videos</a>
                                            </li>
                                            <li><a href="#.html">Cellphones &amp; Accessories</a>
                                            </li>
                                            <li><a href="#.html">Headphones</a>
                                            </li>
                                            <li><a href="#.html">Videosgames</a>
                                            </li>
                                            <li><a href="#.html">Wireless Speakers</a>
                                            </li>
                                            <li><a href="#.html">Office Electronic</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-menu__column">
                                        <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#.html">Digital Cables</a>
                                            </li>
                                            <li><a href="#.html">Audio &amp; Video Cables</a>
                                            </li>
                                            <li><a href="#.html">Batteries</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#.html">Clothing &amp; Apparel</a>
                            </li>
                            <li><a href="#.html">Home, Garden &amp; Kitchen</a>
                            </li>
                            <li><a href="#.html">Health &amp; Beauty</a>
                            </li>
                            <li><a href="#.html">Yewelry &amp; Watches</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a href="#">Computer &amp; Technology</a><span class="sub-toggle"></span>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#.html">Computer &amp; Tablets</a>
                                            </li>
                                            <li><a href="#.html">Laptop</a>
                                            </li>
                                            <li><a href="#.html">Monitors</a>
                                            </li>
                                            <li><a href="#.html">Networking</a>
                                            </li>
                                            <li><a href="#.html">Drive &amp; Storages</a>
                                            </li>
                                            <li><a href="#.html">Computer Components</a>
                                            </li>
                                            <li><a href="#.html">Security &amp; Protection</a>
                                            </li>
                                            <li><a href="#.html">Gaming Laptop</a>
                                            </li>
                                            <li><a href="#.html">Accessories</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#.html">Babies &amp; Moms</a>
                            </li>
                            <li><a href="#.html">Sport &amp; Outdoor</a>
                            </li>
                            <li><a href="#.html">Phones &amp; Accessories</a>
                            </li>
                            <li><a href="#.html">Books &amp; Office</a>
                            </li>
                            <li><a href="#.html">Cars &amp; Motocycles</a>
                            </li>
                            <li><a href="#.html">Home Improments</a>
                            </li>
                            <li><a href="#.html">Vouchers &amp; Services</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
                <form class="ps-form--quick-search" action="index.html" method="get">
                    <div class="form-group--icon"><i class="icon-chevron-down"></i>
                        <select class="form-control">
                            <option value="1">All</option>
                            <option value="1">Smartphone</option>
                            <option value="1">Sounds</option>
                            <option value="1">Technology toys</option>
                        </select>
                    </div>
                    <input class="form-control" type="text" placeholder="I'm shopping for...">
                    <button>Search</button>
                </form>
            </div>
            <div class="header__content-right">
                <div class="header__actions"><a class="header__extra" href="#"><i class="icon-heart"></i><span><i>0</i></span></a>
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
                    @include('layouts.parts.header.user')
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container">
            <div class="navigation__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span>Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <li><a href="#.html">Hot Promotions</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a href="#">Consumer Electronic</a><span class="sub-toggle"></span>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Electronic<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#.html">Home Audio &amp; Theathers</a>
                                            </li>
                                            <li><a href="#.html">TV &amp; Videos</a>
                                            </li>
                                            <li><a href="#.html">Camera, Photos &amp; Videos</a>
                                            </li>
                                            <li><a href="#.html">Cellphones &amp; Accessories</a>
                                            </li>
                                            <li><a href="#.html">Headphones</a>
                                            </li>
                                            <li><a href="#.html">Videosgames</a>
                                            </li>
                                            <li><a href="#.html">Wireless Speakers</a>
                                            </li>
                                            <li><a href="#.html">Office Electronic</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-menu__column">
                                        <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#.html">Digital Cables</a>
                                            </li>
                                            <li><a href="#.html">Audio &amp; Video Cables</a>
                                            </li>
                                            <li><a href="#.html">Batteries</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#.html">Clothing &amp; Apparel</a>
                            </li>
                            <li><a href="#.html">Home, Garden &amp; Kitchen</a>
                            </li>
                            <li><a href="#.html">Health &amp; Beauty</a>
                            </li>
                            <li><a href="#.html">Yewelry &amp; Watches</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a href="#">Computer &amp; Technology</a><span class="sub-toggle"></span>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#.html">Computer &amp; Tablets</a>
                                            </li>
                                            <li><a href="#.html">Laptop</a>
                                            </li>
                                            <li><a href="#.html">Monitors</a>
                                            </li>
                                            <li><a href="#.html">Networking</a>
                                            </li>
                                            <li><a href="#.html">Drive &amp; Storages</a>
                                            </li>
                                            <li><a href="#.html">Computer Components</a>
                                            </li>
                                            <li><a href="#.html">Security &amp; Protection</a>
                                            </li>
                                            <li><a href="#.html">Gaming Laptop</a>
                                            </li>
                                            <li><a href="#.html">Accessories</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#.html">Babies &amp; Moms</a>
                            </li>
                            <li><a href="#.html">Sport &amp; Outdoor</a>
                            </li>
                            <li><a href="#.html">Phones &amp; Accessories</a>
                            </li>
                            <li><a href="#.html">Books &amp; Office</a>
                            </li>
                            <li><a href="#.html">Cars &amp; Motocycles</a>
                            </li>
                            <li><a href="#.html">Home Improments</a>
                            </li>
                            <li><a href="#.html">Vouchers &amp; Services</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation__right">
                <ul class="menu">
                    <li class="menu-item-has-children"><a href="index">Home</a><span class="sub-toggle"></span>
                        <ul class="sub-menu">
                            <li><a href="index.html">Marketplace Full Width</a>
                            </li>
                            <li><a href="home-autopart.html">Home Auto Parts</a>
                            </li>
                            <li><a href="home-technology.html">Home Technology</a>
                            </li>
                            <li><a href="home-organic.html">Home Organic</a>
                            </li>
                            <li><a href="home-marketplace.html">Home Marketplace V1</a>
                            </li>
                            <li><a href="home-marketplace-2.html">Home Marketplace V2</a>
                            </li>
                            <li><a href="home-marketplace-3.html">Home Marketplace V3</a>
                            </li>
                            <li><a href="home-marketplace-4.html">Home Marketplace V4</a>
                            </li>
                            <li><a href="home-electronic.html">Home Electronic</a>
                            </li>
                            <li><a href="home-furniture.html">Home Furniture</a>
                            </li>
                            <li><a href="home-kid.html">Home Kids</a>
                            </li>
                            <li><a href="homepage-photo-and-video.html">Home photo and picture</a>
                            </li>
                            <li><a href="home-medical.html">Home Medical</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children has-mega-menu"><a href="shop-default">Shop</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4>Catalog Pages<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="shop-default.html">Shop Default</a>
                                    </li>
                                    <li><a href="shop-default.html">Shop Fullwidth</a>
                                    </li>
                                    <li><a href="shop-categories.html">Shop Categories</a>
                                    </li>
                                    <li><a href="shop-sidebar.html">Shop Sidebar</a>
                                    </li>
                                    <li><a href="shop-sidebar-without-banner.html">Shop Without Banner</a>
                                    </li>
                                    <li><a href="shop-carousel.html">Shop Carousel</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Product Layout<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="product-default.html">Default</a>
                                    </li>
                                    <li><a href="product-extend.html">Extended</a>
                                    </li>
                                    <li><a href="product-full-content.html">Full Content</a>
                                    </li>
                                    <li><a href="product-box.html">Boxed</a>
                                    </li>
                                    <li><a href="product-sidebar.html">Sidebar</a>
                                    </li>
                                    <li><a href="product-default.html">Fullwidth</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Product Types<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="product-default.html">Simple</a>
                                    </li>
                                    <li><a href="product-default.html">Color Swatches</a>
                                    </li>
                                    <li><a href="product-image-swatches.html">Images Swatches</a>
                                    </li>
                                    <li><a href="product-countdown.html">Countdown</a>
                                    </li>
                                    <li><a href="product-multi-vendor.html">Multi-Vendor</a>
                                    </li>
                                    <li><a href="product-instagram.html">Instagram</a>
                                    </li>
                                    <li><a href="product-affiliate.html">Affiliate</a>
                                    </li>
                                    <li><a href="product-on-sale.html">On sale</a>
                                    </li>
                                    <li><a href="product-video.html">Video Featured</a>
                                    </li>
                                    <li><a href="product-groupped.html">Grouped</a>
                                    </li>
                                    <li><a href="product-out-stock.html">Out Of Stock</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Woo Pages<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="shopping-cart.html">Shopping Cart</a>
                                    </li>
                                    <li><a href="checkout.html">Checkout</a>
                                    </li>
                                    <li><a href="whishlist.html">Whishlist</a>
                                    </li>
                                    <li><a href="compare.html">Compare</a>
                                    </li>
                                    <li><a href="order-tracking.html">Order Tracking</a>
                                    </li>
                                    <li><a href="my-account.html">My Account</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item-has-children has-mega-menu"><a href="">Pages</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4>Basic Page<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="about-us.html">About Us</a>
                                    </li>
                                    <li><a href="contact-us.html">Contact</a>
                                    </li>
                                    <li><a href="faqs.html">Faqs</a>
                                    </li>
                                    <li><a href="comming-soon.html">Comming Soon</a>
                                    </li>
                                    <li><a href="404-page.html">404 Page</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Vendor Pages<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="become-a-vendor.html">Become a Vendor</a>
                                    </li>
                                    <li><a href="vendor-store.html">Vendor Store</a>
                                    </li>
                                    <li><a href="vendor-dashboard-free.html">Vendor Dashboard Free</a>
                                    </li>
                                    <li><a href="vendor-dashboard-pro.html">Vendor Dashboard Pro</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item-has-children has-mega-menu"><a href="">Blogs</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4>Blog Layout<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="blog-grid.html">Grid</a>
                                    </li>
                                    <li><a href="blog-list.html">Listing</a>
                                    </li>
                                    <li><a href="blog-small-thumb.html">Small Thumb</a>
                                    </li>
                                    <li><a href="blog-left-sidebar.html">Left Sidebar</a>
                                    </li>
                                    <li><a href="blog-right-sidebar.html">Right Sidebar</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Single Blog<span class="sub-toggle"></span></h4>
                                <ul class="mega-menu__list">
                                    <li><a href="blog-detail.html">Single 1</a>
                                    </li>
                                    <li><a href="blog-detail-2.html">Single 2</a>
                                    </li>
                                    <li><a href="blog-detail-3.html">Single 3</a>
                                    </li>
                                    <li><a href="blog-detail-4.html">Single 4</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
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
