@include('layouts.parts.header.topbar')
<!-- header middle -->
<div class="header_middle pt25 pb25 dn-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xl-3">
                <div class="header_top_logo_home1">
                    <img src="images/header-middle-logo.svg" alt="header-middle-logo.svg">
                </div>
            </div>
            <div class="col-lg-7 col-xl-7">
                <div class="header_middle_advnc_search">
                    <div class="search_form_wrapper">
                        <div class="row">
                            <div class="col-auto pr0">
                                <div class="actegory">
                                    <select class="custom_select_dd" id="selectbox_alCategory">
                                        <option value="AllCategory">All Category</option>
                                        <option value="HotOffers">Hot Offers</option>
                                        <option value="NewArrivals">New Arrivals</option>
                                        <option value="DealsOfTheDay">Deals of The Day</option>
                                        <option value="Fruits">Fruits</option>
                                        <option value="Vegetables">Vegetables</option>
                                        <option value="Drinks">Drinks</option>
                                        <option value="Bakery">Bakery</option>
                                        <option value="Butter&Egges">Butter & Egges</option>
                                        <option value="Milks&Creams">Milks & Creams</option>
                                        <option value="Meats">Meats</option>
                                        <option value="Fish">Fish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto pr0">
                                <div class="top-search">
                                    <form action="#" method="get" class="form-search" accept-charset="utf-8">
                                        <div class="box-search pre_line">
                                            <input class="form_control" type="text" name="search" placeholder="I'm shopping for...">
                                            <div class="search-suggestions">
                                                <div class="box-suggestions">
                                                    <ul>
                                                        <li>
                                                            <div class="thumb">
                                                                <img src="images/listing/sf1.png" alt="sf1.png">
                                                            </div>
                                                            <div class="info-product">
                                                                <div class="item_title">Silver Heinz Ketchup 350 ml</div>
                                                                <div class="price"><span class="sale">$50.00</span></div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="thumb">
                                                                <img src="images/listing/sf2.png" alt="sf2.png">
                                                            </div>
                                                            <div class="info-product">
                                                                <div class="item_title">Silver Heinz Ketchup 350 ml</div>
                                                                <div class="price"><span class="sale">$24.00</span></div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="thumb">
                                                                <img src="images/listing/sf3.png" alt="sf3.png">
                                                            </div>
                                                            <div class="info-product">
                                                                <div class="item_title">Silver Heinz Ketchup 350 ml</div>
                                                                <div class="price"><span class="sale">$90.00</span></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div><!-- /.box-suggestions -->
                                            </div><!-- /.search-suggestions -->
                                        </div><!-- /.box-search -->
                                    </form><!-- /.form-search -->
                                </div><!-- /.top-search -->
                            </div>
                            <div class="col-auto p0">
                                <div class="advscrh_frm_btn">
                                    <button type="submit" class="btn search-btn"><span class="flaticon-search"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="log_fav_cart_widget">
                    <div class="wrapper">
                        <ul class="mb0 cart">
                            <li class="list-inline-item"><a href="#" data-bs-toggle="modal" data-bs-target="#logInModal"><span class="flaticon-user icon"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="flaticon-heart icon"><span class="badge bgc-thm">2</span></span></a></li>
                            <li class="list-inline-item">
                                <a class="cart_btn" href="#"><span class="flaticon-shopping-cart icon"><span class="badge bgc-thm">3</span></span> <span class="price">$240.93</span></a>
                                <ul class="dropdown_content">
                                    <li class="list_content">
                                        <a href="#">
                                            <img class="float-start" src="images/shop/s1.png" alt="50x50">
                                            <p>Silver Heinz Ketchup 350 ml</p>
                                            <small>3 x $7.63</small>
                                            <span class="close_icon float-end"><i class="fa fa-plus"></i></span>
                                        </a>
                                    </li>
                                    <li class="list_content">
                                        <a href="#">
                                            <img class="float-start" src="images/shop/s2.png" alt="50x50">
                                            <p>Silver Heinz Ketchup 350 ml</p>
                                            <small>3 x $7.63</small>
                                            <span class="close_icon float-end"><i class="fa fa-plus"></i></span>
                                        </a>
                                    </li>
                                    <li class="list_content">
                                        <a href="#">
                                            <img class="float-start" src="images/shop/s3.png" alt="50x50">
                                            <p>Silver Heinz Ketchup 350 ml</p>
                                            <small>3 x $7.63</small>
                                            <span class="close_icon float-end"><i class="fa fa-plus"></i></span>
                                        </a>
                                    </li>
                                    <li class="list_content">
                                        <h5>Subtotal: <span class="text-thm fw400 float-end">$907.00</span></h5>
                                        <a href="#" class="btn btn-thm cart_btns">VIEW CART</a>
                                        <a href="#" class="btn btn-thm2 checkout_btns">CHECKOUT</a>
                                    </li>
                                </ul>
                            </li>
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
                <img class="logo2 img-fluid" src="images/header-middle-logo.svg" alt="header-middle-logo.svg">
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
            <!-- Responsive Menu Structure-->
            <ul id="respMenu" class="ace-responsive-menu menu_list_custom_code wa pl330" data-menu-style="horizontal">
                <li> <a href="#"><span class="title">HOME</span></a>
                    <!-- Level Two-->
                    <ul>
                        <li><a href="index.html">Home V1</a></li>
                        <li><a href="index2.html">Home V2</a></li>
                        <li><a href="index3.html">Home V3</a></li>
                        <li><a href="index4.html">Home V4</a></li>
                        <li><a href="index5.html">Home V5</a></li>
                        <li><a href="index6.html">Home V6</a></li>
                        <li><a href="index7.html">Home V7</a></li>
                        <li><a href="index8.html">Home V8</a></li>
                        <li><a href="index9.html">Home V9</a></li>
                        <li><a href="index10.html">Home V10</a></li>
                    </ul>
                </li>
                <li class="megamenu_style"> <a href="#"><span class="title">SHOP</span></a>
                    <ul class="row dropdown-megamenu">
                        <li class="col mega_menu_list pl30">
                            <h4 class="title">Shop Listing</h4>
                            <ul>
                                <li><a href="page-shop-list-v1.html">Listing v1</a></li>
                                <li><a href="page-shop-list-v2.html">Listing v2</a></li>
                                <li><a href="page-shop-list-v3.html">Listing v3</a></li>
                                <li><a href="page-shop-list-v4.html">Listing v4</a></li>
                                <li><a href="page-shop-list-v5.html">Listing v5</a></li>
                                <li><a href="page-shop-list-v6.html">Listing v6</a></li>
                            </ul>
                        </li>
                        <li class="col mega_menu_list">
                            <h4 class="title">Shop Single</h4>
                            <ul>
                                <li><a href="page-shop-single-simple.html">Simple</a></li>
                                <li><a href="page-shop-single-variable.html">Variable</a></li>
                                <li><a href="page-shop-single-group.html">Group</a></li>
                                <li><a href="page-shop-single-affiliate.html">Affiliate</a></li>
                                <li><a href="page-shop-single-countdown.html">Countdown</a></li>
                                <li><a href="page-shop-single-thumbnail-vertical.html">Thumbnail Vertical</a></li>
                                <li><a href="page-shop-single-right-sidebar.html">Right Sidebar</a></li>
                                <li><a href="page-shop-single-three-columns.html">Three Columns</a></li>
                            </ul>
                        </li>
                        <li class="col mega_menu_list">
                            <h4 class="title">User Dashboard</h4>
                            <ul>
                                <li><a href="page-dashboard.html">Dashboard</a></li>
                                <li><a href="page-dashboard-order.html">Orders</a></li>
                                <li><a href="page-dashboard-wish-list.html">Downloads</a></li>
                                <li><a href="page-dashboard-address.html">Addresses</a></li>
                                <li><a href="page-dashboard-account-details.html">Account Details</a></li>
                                <li><a href="page-dashboard-wish-list.html">Wishlist</a></li>
                                <li><a href="page-login.html">Logout</a></li>
                            </ul>
                        </li>
                        <li class="col mega_menu_list">
                            <h4 class="title">SHOP PAGES</h4>
                            <ul>
                                <li><a href="page-shop-cart.html">Cart</a></li>
                                <li><a href="page-shop-checkout.html">Checkout</a></li>
                                <li><a href="page-shop-complete-order.html">Complete Order</a></li>
                                <li><a href="order-tracking.html">Order Tracking</a></li>
                                <li><a href="page-store-location.html">Store Locator</a></li>
                            </ul>
                        </li>
                        <li class="col mega_menu_list">
                            <div class="banner_one megamenu_style">
                                <div class="thumb"><img src="images/banner/31.jpg" alt="31.jpg"></div>
                                <div class="details style2">
                                    <p class="para">Tasty Healthy</p>
                                    <h2 class="title">Fresh Vegetables</h2>
                                    <a href="page-shop-list-v1.html" class="shop_btn style2">SHOP NOW</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li> <a href="#"><span class="title">PAGES</span></a>
                    <ul>
                        <li><a href="page-about.html">About Us</a></li>
                        <li><a href="page-error.html">404 Page</a></li>
                        <li><a href="page-faq.html">Faq</a></li>
                        <li><a href="page-invoices.html">Invoices</a></li>
                        <li><a href="page-login.html">My Account</a></li>
                        <li><a href="page-terms.html">Terms and Conditions</a></li>
                        <li><a href="page-ui-element.html">UI Elements</a></li>
                    </ul>
                </li>
                <li> <a href="#"><span class="title">BLOG</span></a>
                    <ul>
                        <li><a href="page-blog-grid.html">Blog Grid</a></li>
                        <li><a href="page-blog-grid-sidebar.html">Blog Grid Sidebar</a></li>
                        <li><a href="page-blog-details.html">Blog Details</a></li>
                        <li><a href="page-blog-list.html">Blog List</a></li>
                        <li><a href="page-blog-single.html">Blog Single</a></li>
                        <li><a href="page-blog-single2.html">Blog Single v2</a></li>
                    </ul>
                </li>
                <li><a href="page-contact.html">CONTACT</a></li>
            </ul>
            <ul id="respMenu2" class="ace-responsive-menu widget_menu_home2 wa" data-menu-style="horizontal">
                <li class="list-inline-item list_c">
                    <a href="#"><span class="flaticon-phone-call vam mr7"></span> HOTLINE <span class="text-thm fw400 dn-lg">(42) 500-78-42</span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Modal -->
