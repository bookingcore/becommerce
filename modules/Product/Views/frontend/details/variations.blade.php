@if(!empty($row->variations))
    <div class="product-detail-variable">
        @foreach($row->variations as $item=>$value)
            <span class="item-variable" data-price="{{$value->price}}" data-sku="{{$value->sku}}">{{$value->sku}}</span>
        @endforeach
        <div class="product-detail-variable-description">
            <p class="price">
                <span class="amount"></span>
            </p>
            <div class="product-stock-status">{{__('Status:')}} <span></span></div>
        </div>
    </div>
@endif