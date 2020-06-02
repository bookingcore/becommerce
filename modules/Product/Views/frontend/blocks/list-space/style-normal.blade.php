<div class="bravo_style-normal">
    <div class="mf-products-list mf-products woocommerce">
        <div class="cat-header">
            <h2 class="cat-title">{{__($title ?? '')}}</h2>
            <ul class="extra-links">
                @if(!empty($categories))
                    @foreach($categories as $cat)
                        <li><a class="extra-link" href="{{$cat->getDetailUrl()}}">{{ $cat->name }}</a></li>
                    @endforeach
                @endif
                <li><a class="extra-link " href="{{ route("product.index") }}">{{__('View All')}}</a></li>
            </ul>
        </div>

        <div class="products-content">
            <div class="woocommerce">
                <ul class="products list-unstyled">
                    @if(!empty($rows))
                        @foreach($rows as $item)
                            <li class="col-xs-12 col-sm-4 col-md-3 col-lg-3 un-4-cols product">
                                <div class="product-inner">
                                    <div class="mf-product-thumbnail">
                                        <a href="{{$item->getDetailUrl()}}">{!! get_image_tag($item['image_id']) !!}</a>
                                    </div>
                                    <div class="mf-product-details">
                                        <div class="mf-product-content">
                                            <h2><a href="{{$item->getDetailUrl()}}">{{$item['title']}}</a></h2>
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
