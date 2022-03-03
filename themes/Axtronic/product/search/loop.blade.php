<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-loop-product ">
    <div class="product-labels">
        <span class="onsale product-label">
             @if($row->stock_status == "in")
                @if(!empty($row->discount_percent))
                    <div class="">-{{$row->discount_percent}}</div>
                @endif
            @else
                <span class="out-stock">{{__('Out Of Stock')}}</span>
            @endif
        </span>
    </div>
    <div class="bd-placeholder-img card-img-top position-relative">
        <div class="product-img-wrap">
            <a href="{{$row->getDetailUrl()}}" class="d-block mih-200 bg-f1f1f1">
                {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}
            </a>
        </div>
        <!-- <div class="service-wishlist is_loop {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}">
            <i class="fa fa-heart"></i>
        </div>

        <div class="bc-compare left-15 bottom-15 position-absolute c-white cursor-pointer c-main-hover" data-bs-toggle="tooltip" title="{{ __("Compare") }}" data-id="{{$row->id}}">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
        </div> -->
    </div>
    <div class="card-body">
        <h2>
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h2>
        @if(!empty($reviewData['total_review']))
        <div class="card-rating mb-2 d-flex mt-1 align-items-center">
            <!-- @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
            <span>{{$reviewData['total_review']}}
                @if($reviewData['total_review'] > 1)
                    {{ __("Reviews") }}
                @else
                    {{ __("Review") }}
                @endif
            </span> -->
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>
        @endif
        <div class="card-price fs-18 fw-600">
            @include('product.details.price')
        </div>
    </div>
</div>
