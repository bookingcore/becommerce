<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-loop-product border h-full p-4 {{$class ?? ""}}">
    <div class="mb-5">
        <a href="{{$row->getDetailUrl()}}" class="mi-h-230">
            {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'img-fluid w-100']) !!}
        </a>
        <div class="service-wishlist is_loop {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-bs-toggle="tooltip"  title="{{ __("Wishlist") }}">
            <i class="fa fa-heart"></i>
        </div>

        <div class="bc-compare left-15 bottom-15 position-absolute c-white cursor-pointer c-main-hover" data-bs-toggle="tooltip" title="{{ __("Compare") }}" data-id="{{$row->id}}">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
        </div>
    </div>
    <div class="card-body">
        @if($row->brand)
            <div class="mt-2 mb-2"><a class="text-sm color-[#626974] uppercase" href="{{$row->brand->getDetailUrl()}}">{{$row->brand->name}}</a></div>
        @endif
        <a class="text-base font-[500]" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        @if(!empty($reviewData['total_review']))
            <div class="card-rating mb-2 flex mt-2 items-center">
                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                <span class="text-[#626974] ml-3">{{$reviewData['total_review']}}
                    @if($reviewData['total_review'] > 1)
                        {{ __("Reviews") }}
                    @else
                        {{ __("Review") }}
                    @endif
                </span>
            </div>
        @endif
        <div class="card-price flex items-center">
            @include('product.details.price')
            <div class="ml-3 mt-1 text-[#443297]">
                @if($row->stock_status == "in")
                    @if(!empty($row->discount_percent))
                        <div class="badge">{{$row->discount_percent}}{{ __("% Off") }}</div>
                    @endif
                @else
                    <span class="badge out-stock">{{__('Out Of Stock')}}</span>
                @endif
            </div>
        </div>
    </div>
</div>
