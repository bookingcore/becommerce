<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="ps-product {{ $class ?? "" }}">
    <div class="ps-product__thumbnail"><a href="{{$row->getDetailUrl()}}">
        {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title]) !!}
        </a>
        @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <div class="ps-product__badge">-{{$row->discount_percent}}</div>
            @endif
        @else
            <span class="ps-product__badge out-stock">{{__('Out Of Stock')}}</span>
        @endif
        <ul class="ps-product__actions">
            <li><a href="#"  class="bc_add_to_cart" data-product='{!! json_encode(['id'=>$row->id,'type'=>'product']) !!}' data-toggle="tooltip" data-placement="top" title="" data-original-title="Add To Cart"><i class="icon-bag2 "></i></a></li>
            <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Whishlist"><i class="icon-heart"></i></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><i class="icon-chart-bars"></i></a></li>
        </ul>
    </div>
    <div class="ps-product__container">
        @if(is_vendor_enable() and $row->author)
            <a class="ps-product__vendor" href="{{$row->author->getDetailUrl()}}">{{$row->author->display_name}}</a>
        @endif
        <div class="ps-product__container">
            <a class="ps-product__title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
            @if(!empty($reviewData['total_review']))
            <div class="ps-product__rating mb-2 d-flex mt-1">
                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                <span>{{$reviewData['total_review']}}</span>
            </div>
            @endif
            <p class="ps-product__price sale">{{$row->display_price}}
                @if($row->display_sale_price)
                <del>{{$row->display_sale_price}} </del>
                @endif
            </p>
        </div>
    </div>
</div>
