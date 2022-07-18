<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 4:54 PM
 */
?>
<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="product-item product-item-grid">

    <div class="product-transition">
        <div class="product-labels">
            <button class="btn-tooltips btn-wishlist {{$row->isWishList()}} service-wishlist " data-id="{{$row->id}}" data-type="{{$row->type}}"><i class="demus-icon-heart"></i></button>
        </div>
        <div class="product-img-wrap">
            <a href="{{$row->getDetailUrl()}}" >
                {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100 object-cover img-whp']) !!}
            </a>
        </div>
    </div>
    <div class="product-caption">
        <p class="mb-0">
            @if($row->stock_status == "in")
                @if(!empty($row->discount_percent))
                    <span class="onsale product-label">-{{$row->discount_percent}} % </span>
                @else
                    <span class="product-label featured">{{__('Hot')}}</span>
                @endif
            @else
                <span class="out-stock">{{__('Out Of Stock')}}</span>
            @endif
        </p>
        <h2 class="product__title">
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h2>
        @if(!empty($reviewData['total_review']))
            @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
        @endif
        <div class="price">
            @include('product.details.price')
        </div>
    </div>
</div>

