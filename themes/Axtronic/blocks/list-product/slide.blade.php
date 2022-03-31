@if(!empty($rows->count()))
    <div class="axtronic-slider-products mb-5">
        <div class="container">
            <div class="product-box-title">
                <h2 class="heading-title">{{ $title }}</h2>
                <ul class="list-unstyled list-category-name">
                    <li><a href="#" class="button">Soundbar</a></li>
                    <li><a href="#" class="button">Bluetooth</a></li>
                    <li><a href="#" class="button">Headphone</a></li>
                    <li><a href="#" class="button">Earphone</a></li>
                    <li><a href="#" class="button">Wireless</a></li>
                    <li><a href="#" class="button">See all</a></li>
                </ul>
            </div>
            <div class="axtronic-slider-content">
                <div class="product-slider swiper-container">
                    <div class="swiper-wrapper">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="swiper-slide">
                                    @include('product.search.loop')
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container">
    <div class="product-box-title">
        <h2 class="heading-title">Special Offer Products</h2>
        <ul class="list-unstyled list-category-name">
            <li><a href="#" class="button">See all</a></li>
        </ul>
    </div>
    <ul class="nav list-items list-product-items axtronic-products-special">
        <li class="list-item product-item product-style-2">
            <div class="product-block">
                <span class="hot-title">Hot Offer</span>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
                <div class="product-labels"><span class="onsale product-label">33%Off</span><span class="featured product-label">Hot</span></div>
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                    <div class="shop-action">
                        <button class="btn-tooltips btn-addtocart tooltipstered"><i class="axtronic-icon-shopping-cart"></i></button>
                        <button class="btn-tooltips btn-wishlist tooltipstered" ><i class="axtronic-icon-heart"></i></button>
                        <button class="btn-tooltips btn-quickview tooltipstered" ><i class="axtronic-icon-eye"></i></button>
                        <button class="btn-tooltips btn-compare" ><i class="axtronic-icon-sync"></i></button>
                    </div>
                </div>
                <div class="product-caption">
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                        <del>
                            <span class="woocommerce-Price-amount amount">
                                <bdi>
                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                    110.00
                                </bdi>
                            </span>
                        </del>
                        <ins>
                            <span class="woocommerce-Price-amount amount">
                                <bdi>
                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                    150.00
                                </bdi>
                            </span>
                        </ins>
                    </span>
                </div>
                <div class="deal-sold">
                    <div class="deal-sold-text">
                        Only <span>24</span> item(s) left in stock. </div>
                    <div class="deal-progress">
                        <div class="progress-bar">
                            <div class="progress-value" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-item product-item product-style-1">
            <div class="product-list-wrap">
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                </div>
                <div class="product-caption">
                    <div class="product-labels">
                        <span class="onsale product-label">-24% </span>
                    </div>
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                        <del>
                            <span class="woocommerce-Price-amount amount">
                                <bdi>
                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                    110.00
                                </bdi>
                            </span>
                        </del>
                        <ins>
                            <span class="woocommerce-Price-amount amount">
                                <bdi>
                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                    150.00
                                </bdi>
                            </span>
                        </ins>
                    </span>
                </div>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-item product-item product-style-1">
            <div class="product-list-wrap">
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                </div>
                <div class="product-caption">
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                        <span class="woocommerce-Price-amount amount">
                            <bdi>
                                <span class="woocommerce-Price-currencySymbol">$</span>
                                110.00
                            </bdi>
                        </span>
                        –
                        <span class="woocommerce-Price-amount amount">
                            <bdi>
                                <span class="woocommerce-Price-currencySymbol">$</span>
                                150.00
                            </bdi>
                        </span>
                    </span>
                </div>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-item product-item product-style-1">
            <div class="product-list-wrap">
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                </div>
                <div class="product-caption">
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            110.00
                                                        </bdi>
                                                    </span>
                                                    –
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            150.00
                                                        </bdi>
                                                    </span>
                                                </span>
                </div>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-item product-item product-style-1">
            <div class="product-list-wrap">
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                </div>
                <div class="product-caption">
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            110.00
                                                        </bdi>
                                                    </span>
                                                    –
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            150.00
                                                        </bdi>
                                                    </span>
                                                </span>
                </div>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-item product-item product-style-1">
            <div class="product-list-wrap">
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                </div>
                <div class="product-caption">
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            110.00
                                                        </bdi>
                                                    </span>
                                                    –
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            150.00
                                                        </bdi>
                                                    </span>
                                                </span>
                </div>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-item product-item product-style-1">
            <div class="product-list-wrap">
                <div class="product-transition">
                    <div class="product-img-wrap ">
                        <div class="product-image"><img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" ></div>
                    </div>
                </div>
                <div class="product-caption">
                    <h2 class="product__title"><a href="#">iPhone 13 Pro Max 256GB</a></h2>
                    <div class="star-rating" role="img" title="70%">
                        <div class="back-stars">
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>
                            <i class="axtronic-icon-star" aria-hidden="true"></i>

                            <div class="front-stars" style="width: 70%">
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                                <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <span class="price">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            110.00
                                                        </bdi>
                                                    </span>
                                                    –
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">$</span>
                                                            150.00
                                                        </bdi>
                                                    </span>
                                                </span>
                </div>
                <div class="time-sale">
                    <div class="deal-text">
                        <span>Remains until the end of the offer</span>
                    </div>
                    <div class="axtronic-countdown" data-countdown="true" data-date="1675814399">
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-days"></span>
                            <span class="countdown-label">days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-hours"></span>
                            <span class="countdown-label">hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-minutes"></span>
                            <span class="countdown-label">mins</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-digits countdown-seconds"></span>
                            <span class="countdown-label">secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
