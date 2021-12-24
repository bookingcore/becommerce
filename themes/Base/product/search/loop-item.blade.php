<?php
$translation = $row->translate();
?>
<div class="ps-product">
    <div class="ps-product__thumbnail"><a href="{{$row->getDetailUrl()}}">
        {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title]) !!}
        </a>
        <div class="ps-product__badge">-16%</div>
        <ul class="ps-product__actions">
            <li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add To Cart"><i class="icon-bag2"></i></a></li>
            <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Whishlist"><i class="icon-heart"></i></a></li>
            <li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><i class="icon-chart-bars"></i></a></li>
        </ul>
    </div>
    <div class="ps-product__container">
        @if($row->author)
            <a class="ps-product__vendor" href="{{$row->author->getDetailUrl()}}">{{$row->author->display_name}}</a>
        @endif

        <div class="ps-product__content"><a class="ps-product__title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
            <div class="ps-product__rating">
                <div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" data-read-only="true" style="display: none;">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                    </select><div class="br-widget br-readonly"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="5"></a><div class="br-current-rating">1</div></div></div><span>01</span>
            </div>
            <p class="ps-product__price sale">{{format_money($row->display_price)}}
                @if($row->display_sale_price)
                <del>{{format_money($row->display_sale_price)}} </del>
                @endif
            </p>
        </div>
        <div class="ps-product__content hover"><a class="ps-product__title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
            <p class="ps-product__price sale">{{format_money($row->display_price)}}
                @if($row->display_sale_price)
                    <del>{{format_money($row->display_sale_price)}} </del>
                @endif
            </p>
        </div>
    </div>
</div>
