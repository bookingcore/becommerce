<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="shop_item fruit_item_grid">
    <div class="thumb">
        {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}
        <div class="thumb_info">
            <ul class="mb0">
                <li class="list-inline-item"><a href="{{$row->getDetailUrl()}}"><span class="flaticon-shopping-cart"></span></a>
                </li>
                <li class="list-inline-item service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}"><a><span
                            class="flaticon-heart"></span></a></li>
                <li class="list-inline-item bc-compare" data-id="{{$row->id}}"><a><span class="flaticon-shuffle"></span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="details text-center">
        @if(!empty($reviewData['total_review']))
            <div class="review mt-2 fz13">
                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
            </div>
        @endif
        <div class="sub_title">{{$translation->title}}</div>
        <div class="si_footer">
            <div class="price">
                @include('product.details.price')
            </div>
        </div>
    </div>
</div>
