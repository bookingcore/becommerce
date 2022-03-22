<div class="axtronic-product-price">
    @if($row->product_type=='variable')
        @if(!empty($priceRange = $row->getMinMaxPriceProductVariations()))
            <p class="price variable-price">
                @if($priceRange['min'] == $priceRange['max'])
                    <span class="amount">{{format_money($priceRange['max'])}}</span>
                @else
                    <span class="amount">{{format_money($priceRange['min'])}}</span>
                    -
                    <span class="amount">{{format_money($priceRange['max'])}}</span>
                @endif
            </p>
        @endif
    @else
        @if(!empty($row->display_sale_price))
            <p class="price has-sale">
                <del>
                    <span class="amount">{{$row->display_sale_price}}</span>
                </del>
                <ins>
                    <span class="amount">{{$row->display_price}}</span>
                </ins>

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

