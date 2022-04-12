<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/9/2022
 * Time: 4:31 PM
 */
$items = \Modules\User\Models\UserWishList::query()
    ->where("user_wishlist.user_id",Auth::id())
    ->orderBy('user_wishlist.id', 'desc')->paginate(6);
?>
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
