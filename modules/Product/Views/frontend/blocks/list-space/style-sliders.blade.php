<div class="mf-product-deals-day woocommerce mf-products-carousel bravo_style-sliders">
    <div class="cat-header">
        <div class="header-content">
            <h2 class="cat-title">{{$title ?? ''}}</h2>
        </div>
        <div class="header-link">
            @if(!empty($categories))
                @foreach($categories as $cat)
                    <li><a class="extra-link" href="{{$cat->getDetailUrl()}}">{{ $cat->name }}</a></li>
                @endforeach
            @endif
            <a href="{{ route("product.index") }}">{{__('View All')}}</a>
        </div>
    </div>
    <div class="products-content">
        <ul class="products">
            @foreach($rows as $item)
                <li class="product">
                    <div class="product-inner">
                        <div class="mf-product-thumbnail">
                            <a href="#">
                                <img src="{{get_file_url($item['image_id'],'thumb')}}" alt="{{$item['title']}}">
                            </a>
                            <div class="footer-button">
                                <a href="#">
                                    <i class="p-icon icon-bag2" data-rel="tooltip"
                                       title="{{__("Add to cart")}}"></i>
                                    <span class="add-to-cart-text">{{__("Add to cart")}}</span>
                                </a>
                                <a href="#" class="mf-product-quick-view">
                                    <i class="p-icon icon-eye" title="{{__('Quick View')}}"></i>
                                </a>
                                <div
                                    class="yith-wcwl-add-to-wishlist add-to-wishlist-90 wishlist-fragment on-first-load"
                                    title="{{__('Add to Wishlist')}}">
                                    <div class="yith-wcwl-add-button">
                                        <a href="#" data-rel="tooltip"
                                           class="add_to_wishlist single_add_to_wishlist">
                                            <i class="yith-wcwl-icon fa fa-heart-o"></i>
                                            <span>{{__('Add to Wishlist')}}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="compare-button mf-compare-button" title="{{__('Compare')}}">
                                    <a href="#" class="compare">{{__('Compare')}}</a>
                                </div>
                            </div>
                        </div>

                        <span class="price">
                            <ins><span class="woocommerce-Price-amount amount">{{ $item->display_price }}</span></ins>
                            <del><span class="woocommerce-Price-amount amount">{{ $item->display_sale_price }}</span></del>
                            @if(!empty($item->discount_percent))
                                <span class="sale"> {{ __(":discount off",["discount"=>$item->discount_percent]) }}</span>
                            @endif
                        </span>

                        <h2>
                            <a href="{{$item->getDetailUrl()}}">{{$item['title'] ?? ''}}</a>
                        </h2>
                        @if($brand = $item->brand->name ?? "")
                            <div class="sold-by-meta">
                                <span class="sold-by-label">{{__('Brand: ')}}</span>
                                <span>{{$brand}}</span>
                            </div>
                        @endif

                        <?php
                        $reviewData = $item->getScoreReview();
                        $score_total = $reviewData['score_total'];
                        ?>
                        <div class="service-review tour-review-{{$score_total}}">
                            <div class="list-star">
                                <ul class="booking-item-rating-stars">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <div class="booking-item-rating-stars-active"
                                     style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                                    <ul class="booking-item-rating-stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <span class="review">
                                @if($reviewData['total_review'] > 1)
                                    {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                                @else
                                    {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                                @endif
                            </span>
                        </div>

                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
