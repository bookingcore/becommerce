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
            <a href="{{$row->getDetailUrl()}}" class="d-block">
                {{--{!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}--}}
                <img src="{{ theme_url('Axtronic/images/iPhone201320.jpg') }}" alt="Axtronic WooCommerce" >
            </a>
        </div>
        <div class="shop-action">
            <button class="btn-tooltips btn-addtocart tooltipstered"><i class="axtronic-icon-shopping-cart"></i></button>
            <button class="btn-tooltips btn-wishlist tooltipstered" ><i class="axtronic-icon-heart"></i></button>
            <button class="btn-tooltips btn-quickview tooltipstered" ><i class="axtronic-icon-eye"></i></button>
            <button class="btn-tooltips btn-compare" ><i class="axtronic-icon-sync"></i></button>
        </div>
    </div>
    <div class="card-body">
        <h2>
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h2>
        @if(!empty($reviewData['total_review']))
        <div class="card-rating mb-2 d-flex mt-1 align-items-center">
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
        <div class="card-price fs-18 fw-600">
            @include('product.details.price')
        </div>
    </div>
</div>
