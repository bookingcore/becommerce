<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-loop-product shop_item">
    <div class="thumb">
        <div class="offer_badge">
            @if($row->stock_status == "in")
                @if(!empty($row->discount_percent))
                    <ul class="mb0">
                        <li><a class="offr_tag" href="#"><span>{{ __("Sale") }}</span></a></li>
                        <li><a class="comison_rate" href="#"><span>-{{$row->discount_percent}}%</span></a></li>
                    </ul>
                @endif
            @else
                <ul class="mb0">
                    <li><a class="offr_tag" href="#"><span>{{ __("Out Of Stock") }}</span></a></li>
                </ul>
            @endif
        </div>
        <a href="{{$row->getDetailUrl()}}">
            {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'']) !!}
        </a>
        <div class="thumb_info">
            <ul class="mb0">
                <li>
                    <a class="service-wishlist is_loop {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}">
                        <i class="fa flaticon-heart"></i>
                    </a>
                </li>
                <li>
                    <a class="bc-compare" data-id="{{$row->id}}">
                        <span class="flaticon-shuffle"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="details text-center">
        <div class="title pb-1 pt-2">
            {{$row->brand->name??""}}
        </div>
        @if(!empty($reviewData['total_review']))
            <div class="review mt-2 fz13">
                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
            </div>
        @endif
        <div class="sub_title">
            <a href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </div>
        <div class="si_footer">
            <div class="price">
                @include('product.details.price')
            </div>
            <a href="{{$row->getDetailUrl()}}" class="cart_btn btn-thm"><span class="flaticon-shopping-cart mr10"></span>{{ __("VIEW DETAIL") }}</a>
        </div>
    </div>
</div>
