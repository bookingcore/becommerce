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
            <ul class="products list-unstyled">
                @if(!empty($rows))
                    @foreach($rows as $row)
                        <li class="col-xs-12 col-sm-4 col-md-3 col-lg-3 un-4-cols product">
                            <div class="product-inner">
                                <div class="mf-product-thumbnail">
                                    <a href="{{$row->getDetailUrl()}}">{!! get_image_tag($row['image_id']) !!}</a>
                                </div>
                                <div class="mf-product-details">
                                    <div class="mf-product-content">
                                        <h2><a href="{{$row->getDetailUrl()}}">{{$row['title']}}</a></h2>
                                        <?php
                                        $reviewData = $row->getScoreReview();
                                        $score_total = $reviewData['score_total'];
                                        ?>
                                        @if($score_total > 0)
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
                                        @endif
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
