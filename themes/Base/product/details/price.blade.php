<h4 class="ps-product__price mt-4">
    @if($row->product_type=='variable')
        @if(!empty($priceRange = getMinMaxPriceProductVariations($row)))
            <p class="price variable-price">
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
        @if(!empty($row->sale_price))
            <p class="price has-sale">
                <ins>
                    <span class="amount">{{format_money($row->sale_price)}}</span>
                </ins>
                <del>
                    <span class="amount">{{format_money($row->price)}}</span>
                </del>
                @if(!empty($row->discount_percent))
                    <span class="sale sale-1">(-{{$row->discount_percent}})</span>
                    <span class="sale sale-2">{{ __(':discount off',['discount'=>$row->discount_percent]) }}</span>
                @endif
            </p>
        @else
            <p class="price single-price">
                <ins><span class="amount">{{format_money($row->price)}}</span></ins>
            </p>
        @endif
    @endif
</h4>

