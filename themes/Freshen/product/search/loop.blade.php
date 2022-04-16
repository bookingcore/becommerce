<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="shop_item">
    <div class="thumb">
        <div class="offer_badge">
            <ul class="mb0">
                <li><a class="offr_tag" href="#"><span>HOT</span></a></li>
                @if(!empty($row->discount_percent) && !empty($show_discount_percent=true))
                    <li><span class="comison_rate" href=""><span >{{__('- :number',['number'=>$row->discount_percent])}}</span></span></li>
                @endif
            </ul>
        </div>
        {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}
        <div class="thumb_info">
            <ul class="mb0">
                <li><a  href="" class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}"><span class="flaticon-heart"></span></a></li>
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
        <div class="sub_title">{{$translation->title}}</div>
        <div class="si_footer">
            @include('product.details.price')
            <a href="{{$row->getDetailUrl()}}" class="cart_btn btn-thm"><span class="flaticon-shopping-cart mr10"></span>{{__('ADD TO CART')}}</a>
        </div>
    </div>
</div>


<div class="bc-loop-product card shadow-sm d-none">
    <div class="bd-placeholder-img card-img-top position-relative">
        <a href="{{$row->getDetailUrl()}}" class="d-block mih-200 bg-f1f1f1">
            {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}
        </a>
        @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <div class="badge">-{{$row->discount_percent}}</div>
            @endif
        @else
            <span class="badge out-stock">{{__('Out Of Stock')}}</span>
        @endif

        <div class="service-wishlist is_loop {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}">
            <i class="fa fa-heart"></i>
        </div>

        <div class="bc-compare left-15 bottom-15 position-absolute c-white cursor-pointer c-main-hover" data-bs-toggle="tooltip" title="{{ __("Compare") }}" data-id="{{$row->id}}">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
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
        <div class="card-price fs-18 fw-600">
            @include('product.details.price')
        </div>
    </div>
</div>
