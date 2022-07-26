<div class="bc-product-price">
    @if($row->product_type=='variable')
        <p class="price variable-price m-0">
            @if($row->min_price == $row->max_price)
                <span class="amount">{{format_money($row->min_price)}}</span>
            @else
                <span class="amount">{{format_money($row->min_price)}}</span>
                -
                <span class="amount">{{format_money($row->max_price)}}</span>
            @endif
        </p>
    @else
        @if(!empty($row->display_sale_price))
            <p class="price has-sale m-0">
                <ins>
                    <span class="amount">{{format_money($row->sale_price)}}</span>
                </ins>
                <del>
                    <span class="amount">{{format_money($row->origin_price)}}</span>
                </del>
                @if(!empty($row->discount_percent) && !empty($show_discount_percent))
                    <span class="sale sale-1">(-{{$row->discount_percent}}%)</span>
                @endif
            </p>
        @else
            <p class="price single-price m-0">
                <ins><span class="amount">{{format_money($row->sale_price)}}</span></ins>
            </p>
        @endif
    @endif
</div>

