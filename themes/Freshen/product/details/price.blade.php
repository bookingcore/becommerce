<div class="bc-product-price">
    @if($row->product_type=='variable')
            <p class="price variable-price">
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
            <p class="price has-sale m-0 c-f30 fs-16">
                <ins class="fs-18 fw-700 text-decoration-none pe-1">
                    <span class="amount">{{$row->display_price}}</span>
                </ins>
                <del class="c-000000 pe-1">
                    <span class="amount">{{$row->display_sale_price}}</span>
                </del>
                @if(!empty($row->discount_percent) && !empty($show_discount_percent))
                    <span class="sale sale-1">(-{{$row->discount_percent}})</span>
                @endif
            </p>
        @else
            <p class="price single-price m-0">
                <ins><span class="amount">{{format_money($row->price)}}</span></ins>
            </p>
        @endif
    @endif
</div>

