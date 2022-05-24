<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="axtronic-loop-product product-item">
    <div class="product-labels">
         @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <span class="onsale product-label">-{{$row->discount_percent}} %</span>
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
                {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100 object-cover img-whp']) !!}
            </a>
        </div>
        <div class="shop-action">
            <form class="axtronic_form_add_to_cart" action="{{route('cart.addToCart')}}">
                @csrf
                <input type="hidden" name="object_model" value="product">
                <input type="hidden" name="object_id" value="{{$row->id}}">
                @if( $row->product_type == 'simple' and $row->stock_status == 'in')
                    <input class="form-control" name="quantity" type="hidden" value="1">
                    <button type="submit" class="btn-tooltips btn-add-to-cart axtronic_add_to_cart btn-addtocart">
                        <i class="axtronic-icon-shopping-cart"></i>
                    </button>
                @endif
                @if($row->product_type == 'variable')
                    <a href="{{$row->getDetailUrl()}}" rel="nofollow" class="btn-tooltips btn-addtocart">
                        <i class="axtronic-icon-shopping-cart"></i>
                    </a>
                @endif
                @if($row->product_type == 'external')
                    <a href="{{ $row->external_url }}" rel="nofollow" class="btn-tooltips btn-addtocart">
                        <i class="axtronic-icon-shopping-cart"></i>
                    </a>
                @endif
                <a href="javascript:void(0)"  class="btn-tooltips btn-wishlist {{$row->isWishList()}} service-wishlist is_loop" data-id="{{$row->id}}" data-type="{{$row->type}}"><i class="axtronic-icon-heart"></i></a>
                <button class="btn-tooltips btn-quickview" ><i class="axtronic-icon-eye"></i></button>
                <button class="btn-tooltips btn-compare axtronic-compare"  data-id="{{$row->id}}"><i class="axtronic-icon-sync"></i></button>
            </form>

        </div>
    </div>
    <div class="product-caption">
        <h2 class="product__title">
            <a class="card-title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h2>
        <div class="axtronic-list-dot mb-2">
            {!! clean($row->short_desc) !!}
        </div>
        @if(!empty($reviewData['total_review']))
            @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
        @endif
        <div class="price">
            @include('product.details.price')
        </div>
        <div class="shop-action shop-action-list">
            <button class="btn-tooltips btn-addtocart "><i class="axtronic-icon-shopping-cart"></i> {{ __('Add to card')  }}</button>
            <a href="javascript:void(0)" class="btn-tooltips btn-wishlist service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}"><i class="axtronic-icon-heart"></i></a>
            <button class="btn-tooltips btn-quickview " ><i class="axtronic-icon-eye"></i></button>
            <button class="btn-tooltips btn-compare"  data-id="{{$row->id}}"><i class="axtronic-icon-sync"></i></button>
        </div>
    </div>
</div>
