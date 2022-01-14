<h4 class="bc-product_price mb-4">
    @if($row->product_type=='variable')
        @if(!empty($priceRange = $row->getMinMaxPriceProductVariations()))
            <p class="price variable-price m-0">
                @if($priceRange['min'] == $priceRange['max'])
                    <ins><span class="amount">{{format_money($priceRange['max'])}}</span></ins>
                @else
                    <ins>
                        <span class="amount">{{format_money($priceRange['min'])}}</span>
                        -
                        <span class="amount">{{format_money($priceRange['max'])}}</span>
                    </ins>
                @endif
            </p>
        @endif
    @else
        @if(!empty($row->display_sale_price))
            <p class="price has-sale m-0">
                <ins>
                    <span class="amount">{{$row->display_price}}</span>
                </ins>
                <del>
                    <span class="amount">{{$row->display_sale_price}}</span>
                </del>
                @if(!empty($row->discount_percent))
                    <span class="sale sale-1">(-{{$row->discount_percent}})</span>
                @endif
            </p>
        @else
            <p class="price single-price m-0">
                <ins><span class="amount">{{format_money($row->price)}}</span></ins>
            </p>
        @endif
    @endif
</h4>

