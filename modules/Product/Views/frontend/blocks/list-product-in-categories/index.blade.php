<div class="bravo_ProductInCategories">
    <div class="martfury-container">
        <div class="mf-products-tabs">
            <div class="tabs-header">
                <h2>
                    <span class="cat-title">{{__($title)}}</span>
                </h2>
                <div class="tabs-header-nav">
                    <ul class="tabs-nav">
                        <li><a href="#" data-href="recent">{{__('New Arrivals')}}</a></li>
                        <li><a href="#" data-href="best_selling">{{__('Best Seller')}}</a></li>
                        <li><a href="#" data-href="top_rated">{{__('Most Popular')}}</a></li>
                    </ul>
                    <a class="link" href="#">{{__('View All')}}</a></div>
            </div>
            <div class="tabs-content">
                <div class="woocommerce">
                    <ul class="products list-unstyled">
                        @if(!empty($rows))
                            @foreach($rows as $item)
                                <li class="product type-product">
                                    <div class="product-inner">
                                        <div class="mf-product-thumbnail">
                                            <a href="#">
                                                @if($image = get_image_tag($item['image_id']))
                                                    <img src="{{get_file_url($item['image_id'],'thumb')}}" alt="{{$item['title'] ?? ''}}">
                                                @endif
                                                @if(!empty($item->discount_percent))
                                                    <span class="ribbons">
                                                                <span class="onsale ribbon">
                                                                    <span class="sep">-</span>{{$item->discount_percent}}
                                                                </span>
                                                            </span>
                                                @endif
                                            </a>

                                            <div class="footer-button">
                                                <a href="#">
                                                    <i class="p-icon icon-bag2" data-rel="tooltip" title="{{__('Add to cart')}}"></i>
                                                    <span class="add-to-cart-text">{{__('Add to cart')}}</span>
                                                </a>
                                                <a href="#" class="mf-product-quick-view">
                                                    <i class="p-icon icon-eye" title="{{__('Quick View')}}" data-rel="tooltip"></i>
                                                </a>
                                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-31 wishlist-fragment on-first-load">
                                                    <!-- ADD TO WISHLIST -->

                                                    <div class="yith-wcwl-add-button">
                                                        <a href="#" title="{{__('Add to Wishlist')}}" tabindex="0">
                                                            <i class="yith-wcwl-icon fa fa-heart-o"></i>
                                                            <span>{{__('Add to Wishlist')}}</span>
                                                        </a>
                                                    </div>
                                                    <!-- COUNT TEXT -->

                                                </div>
                                                <div class="compare-button mf-compare-button">
                                                    <a href="#" class="compare" title="{{__('Compare')}}">{{__('Compare')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mf-product-details">
                                            <div class="mf-product-content">
                                                <div class="mf-vendor-name">
                                                    <div class="sold-by-meta">
                                                        <span class="sold-by-label">{{__('Brand: ')}}</span>
                                                        <a href="#">{{$item->brand->name}}</a>
                                                    </div>
                                                </div>

                                                <h2><a href="#">{{__($item['title']) ?? ''}}</a></h2>

                                                <?php
                                                $reviewData = (!empty($item)) ? $item->getScoreReview() : [];
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


                                                <div class="sold-by-meta">
                                                    <span class="sold-by-label">{{__('Brand: ')}}</span>
                                                    <a href="#">{{$item->brand->name ?? ''}}</a></div>
                                            </div>

                                            <div class="mf-product-price-box">
                                                        <span class="price">
                                                            <ins><span class="woocommerce-Price-amount amount">{{ $item->display_price }}</span></ins>
                                                            <del><span class="woocommerce-Price-amount amount">{{ $item->display_sale_price }}</span></del>
                                                            @if(!empty($item->discount_percent))
                                                                <span class="sale"> {{ __(":discount off",["discount"=>$item->discount_percent]) }}</span>
                                                            @endif
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
