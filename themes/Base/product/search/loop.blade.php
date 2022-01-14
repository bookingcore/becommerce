<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-loop-product card shadow-sm">
    <div class="bd-placeholder-img card-img-top position-relative">
        <a href="{{$row->getDetailUrl()}}" class="d-block">
            {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid']) !!}
        </a>
        @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <div class="badge">-{{$row->discount_percent}}</div>
            @endif
        @else
            <span class="badge out-stock">{{__('Out Of Stock')}}</span>
        @endif

        <div class="service-wishlist is_loop {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
            <i class="fa fa-heart"></i>
        </div>
    </div>
    <div class="card-body">
        <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        @if(!empty($reviewData['total_review']))
            <div class="card-rating mb-2 d-flex mt-1 align-items-center">
                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                <span>{{$reviewData['total_review']}}
                    @if($reviewData['total_review'] > 1)
                        {{ __("Reviews") }}
                    @else
                        {{ __("Review") }}
                    @endif
                </span>
            </div>
        @endif
        <div class="card-price fs-18 fw-600 @if($row->display_sale_price) sale @endif">
            {{$row->display_price}}
            @if($row->display_sale_price)
                <del>{{$row->display_sale_price}} </del>
            @endif
        </div>
    </div>
</div>