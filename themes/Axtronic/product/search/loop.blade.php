<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="axtronic-loop-product product-item">
    <div class="product-labels">
         @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <span class="onsale product-label">-{{$row->discount_percent}} </span>
            @else
                <span class="product-label featured">{{__('Hot')}}</span>
            @endif
        @else
            <span class="out-stock">{{__('Out Of Stock')}}</span>
        @endif
    </div>
    <div class="product-transition">
        <div class="product-img-wrap">
            <a href="{{$row->getDetailUrl()}}" >
                {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}
{{--                <img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" >--}}
            </a>
        </div>
        <div class="shop-action">
            <button class="btn-tooltips btn-addtocart"><i class="axtronic-icon-shopping-cart"></i></button>
            <button class="btn-tooltips btn-wishlist {{$row->isWishList()}} service-wishlist is_loop {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}"><i class="axtronic-icon-heart"></i></button>
            <button class="btn-tooltips btn-quickview" ><i class="axtronic-icon-eye"></i></button>
            <button class="btn-tooltips btn-compare bc-compare"  data-id="{{$row->id}}"><i class="axtronic-icon-sync"></i></button>
        </div>
    </div>
    <div class="product-caption">
        <h2 class="product__title">
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h2>
        @if(!empty($reviewData['total_review']))
        <div class="card-rating mb-2 mt-1 ">
            <div class="star-rating" role="img" title="70%">
                <div class="back-stars">
                    <i class="axtronic-icon-star" aria-hidden="true"></i>
                    <i class="axtronic-icon-star" aria-hidden="true"></i>
                    <i class="axtronic-icon-star" aria-hidden="true"></i>
                    <i class="axtronic-icon-star" aria-hidden="true"></i>
                    <i class="axtronic-icon-star" aria-hidden="true"></i>
                    <div class="front-stars" style="width: 70%">
                        <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                        <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                        <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                        <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                        <i class="axtronic-icon-star-sharp" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="price">
            @include('product.details.price')
        </div>
        <div class="shop-action shop-action-list">
            <button class="btn-tooltips btn-addtocart "><i class="axtronic-icon-shopping-cart"></i> {{ __('Add to card')  }}</button>
            <button class="btn-tooltips btn-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}"><i class="axtronic-icon-heart"></i></button>
            <button class="btn-tooltips btn-quickview " ><i class="axtronic-icon-eye"></i></button>
            <button class="btn-tooltips btn-compare"  data-id="{{$row->id}}"><i class="axtronic-icon-sync"></i></button>
        </div>
    </div>
</div>
