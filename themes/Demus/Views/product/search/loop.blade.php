<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class=" product-item">
    <div class="product-labels">
        @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <span class="onsale">{{__('Sale')}}</span>
            @else
                <span class="featured">{{__('Hot')}}</span>
            @endif
        @else
            <span class="out-stock">{{__('Out Of Stock')}}</span>
        @endif
    </div>
    <div class="product-transition">
        <div class="product-img-wrap">
            <a href="{{$row->getDetailUrl()}}" >
                {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100 object-cover img-whp']) !!}
            </a>
        </div>
        <div class="shop-action">
            <a href="javascript:void(0)"  class="btn-tooltips btn-wishlist {{$row->isWishList()}} service-wishlist is_loop" data-id="{{$row->id}}" data-type="{{$row->type}}"><i class="axtronic-icon-heart"></i></a>
            <button class="btn-tooltips btn-quickview bc-product-quick-view" data-product="{{$row->id}}" data-type="{{$row->type}}"><i class="axtronic-icon-expand-alt"></i></button>
        </div>
        <div class="form-add_to_cart">
            <form class="bc_form_add_to_cart" action="{{route('cart.addToCart')}}">
                @csrf
                <input type="hidden" name="object_model" value="product">
                <input type="hidden" name="object_id" value="{{$row->id}}">
                @if( $row->product_type == 'simple' and $row->stock_status == 'in')
                    <input class="form-control" name="quantity" type="hidden" value="1">
                    <button type="submit" class="btn-tooltips btn-addtocart">
                        <i class="axtronic-icon-shopping-cart"></i> <span>{{ __("Add to cart") }}</span>
                    </button>
                @endif
                @if($row->product_type == 'variable')
                    <a href="{{$row->getDetailUrl()}}" rel="nofollow" class="btn-tooltips btn-addtocart">
                        <i class="axtronic-icon-shopping-cart"></i> <span>{{ __("Select Option") }}</span>
                    </a>
                @endif
                @if($row->product_type == 'external')
                    <a href="{{ $row->external_url }}" rel="nofollow" class="btn-tooltips btn-addtocart">
                        <i class="axtronic-icon-shopping-cart"></i> <span>{{ __("View Detail") }}</span>
                    </a>
                @endif
            </form>
        </div>

    </div>
    <div class="product-caption">
        <h2 class="product__title">
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h2>
        @include('product.details.price')
    </div>
</div>
