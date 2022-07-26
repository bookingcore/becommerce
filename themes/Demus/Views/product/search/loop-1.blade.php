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
<div class="product-item product-item-list">

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
        <h5 class="product__title">
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h5>
        <div class="price">
            @include('product.details.price')
        </div>
    </div>
</div>

