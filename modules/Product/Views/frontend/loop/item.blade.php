<div class="product-item clearfix">
    <div class="product-thumbnail">
        <a href="{{$row->getDetailUrl()}}" tabindex="0">
            <img src="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2013/06/14a-300x300.jpg" data-original="http://demo2.drfuri.com/martfury3/wp-content/uploads/sites/38/2013/06/14a-300x300.jpg" alt="" class="" width="300" height="300" style="display: block;">
            @if(!empty($row->discount_percent))
                <span class="ribbons"><span class="onsale ribbon"><span class="sep">-</span>{{$row->discount_percent}}</span></span>
            @endif
        </a>
        <div class="footer-button">
            <a href="{{$row->getDetailUrl()}}" data-quantity="1" data-title="{{$row->title}}" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="{{$row->id}}" data-product_sku="{{$row->sku}}" aria-label="Add “{{$row->title}}” to your cart" rel="nofollow" tabindex="0"><i class="p-icon icon-bag2" data-toggle="tooltip" title="Add to cart"></i></a>
            <a href="{{$row->getDetailUrl()}}" data-id="{{$row->id}}" class="product-quick-view" tabindex="0"><i class="p-icon icon-eye" title="Quick View" data-toggle="tooltip"></i></a>
            <a href="#" class="wishlist" data-toggle="tooltip" title="Add To Wishlist" data-product_id="{{$row->id}}" tabindex="0"></a>
            <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-product_id="{{$row->id}}" tabindex="0"></a>
        </div>
    </div>
    <div class="product-item-inner">
        <div class="product-content">
            <div class="vendor-name">
                <div class="sold-by-meta"><span class="sold-by-label"></span><a href="http://demo2.drfuri.com/martfury3/vendor/iclever/" tabindex="0">Robert’s Store</a></div>
            </div>
            <h2><a href="{{$row->getDetailUrl()}}" tabindex="0">{{$row->title}}</a></h2>
            <div class="product-rating">
                <div class="brand-review">
					<?php
					$reviewData = $row->review_data;
					$score_total = $reviewData['score_total'];
					?>
                    <div class="service-review product-review-{{$score_total}}">
                        <div class="list-star">
                            <ul class="booking-item-rating-stars">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </ul>
                            <div class="booking-item-rating-stars-active" style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                                <ul class="booking-item-rating-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        @if(!empty($reviewData['total_review']))
                            <span class="review">
                                {{$reviewData['total_review']}}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="product-price-box">
            @include('Product::frontend.details.price')
        </div>
        <div class="product-details-hover">
            <div class="sold-by-meta"><span class="sold-by-label"></span><a href="http://demo2.drfuri.com/martfury3/vendor/iclever/" tabindex="0">Robert’s Store</a></div>
            <h2><a href="{{$row->getDetailUrl()}}" tabindex="0">{{$row->title}}</a></h2>
            @include('Product::frontend.details.price')
        </div>
    </div>
</div>