<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="shop_item">
    <div class="thumb">
        <div class="offer_badge">
            <ul class="mb0">
                @if($row->is_featured)
                    <li><span class="offr_tag" href="#"><span>HOT</span></span></li>
                @endif
                @if(!empty($row->discount_percent) && !empty($show_discount_percent=true))
                    <li><span class="comison_rate" >{{__('- :number',['number'=>$row->discount_percent])}}</span></li>
                @endif
            </ul>
        </div>
        <a href="{{$row->getDetailUrl()}}">{!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}</a>
        <div class="thumb_info">
            <ul class="mb0">
                <li><span class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}"><span class="flaticon-heart"></span></span></li>
                <li><a href="{{$row->getDetailUrl()}}"><span class="flaticon-search"></span></a></li>
            </ul>
        </div>
    </div>
    <div class="details text-center">
        <div class="title">{{$row->brand->name??""}}</div>
        <div class="review">
            @if(!empty($reviewData['total_review']))
                <div class="review mt-2 fz13">
                    @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                </div>
            @endif

        </div>
        <div class="sub_title"><a href="{{$row->getDetailUrl()}}">{{$translation->title}}</a></div>
        <div class="si_footer">
            @include('product.details.price')
            <a href="{{$row->getDetailUrl()}}" class="cart_btn btn-thm"><span class="flaticon-shopping-cart mr10"></span>{{__('ADD TO CART')}}</a>
        </div>
    </div>
</div>

