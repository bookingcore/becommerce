@if($row->product_type=='variable')
    @if(!empty($priceRange = $row->getMinMaxPriceProductVariations()))
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
                <span class="sale">(-{{$row->discount_percent}})</span>
            @endif
        </p>
    @else
        <p class="price single-price">
            <ins><span class="amount">{{format_money($row->price)}}</span></ins>
        </p>
    @endif
@endif
