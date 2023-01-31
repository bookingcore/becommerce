<div class="bc-product-price">
    @if($row->product_type=='variable')
            <div class="text-lg font-medium">
                @if($row->min_price == $row->max_price)
                    <span class="amount">{{format_money($row->min_price)}}</span>
                @else
                    <span class="amount">{{format_money($row->min_price)}}</span>
                    -
                    <span class="amount">{{format_money($row->max_price)}}</span>
                @endif
            </div>
    @else
        @if(!empty($row->display_sale_price))
            <div class="price has-sale m-0">
                <span class="text-lg font-medium">
                    <span class="amount">{{$row->display_price}}</span>
                </span>
                <span class="text-sm color-[#626974]">
                    <span class="line-through">{{$row->display_sale_price}}</span>
                </span>
                @if(!empty($row->discount_percent) && !empty($show_discount_percent))
                    <span class="sale color-[#443297]">(-{{$row->discount_percent}})</span>
                @endif
            </div>
        @else
            <div class="text-lg font-medium">
                <ins><span class="amount">{{format_money($row->price)}}</span></ins>
            </div>
        @endif
    @endif
</div>

