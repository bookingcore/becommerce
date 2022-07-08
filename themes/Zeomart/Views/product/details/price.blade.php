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
            <p class="price has-sale m-0 c-f30 fs-16">
                <span class="text-lg font-medium">
                    <span class="amount">{{$row->display_price}}</span>
                </span>
                <span class="c-000000 pe-1 text-gray-500">
                    <span class="amount">{{$row->display_sale_price}}</span>
                </span>
                @if(!empty($row->discount_percent) && !empty($show_discount_percent))
                    <span class="sale sale-1">(-{{$row->discount_percent}})</span>
                @endif
            </p>
        @else
            <div class="text-lg font-medium">
                <ins><span class="amount">{{format_money($row->price)}}</span></ins>
            </div>
        @endif
    @endif
</div>

