<div class="bc-product_specification mb-2 fs-14">
    @if($row->sku and $row->product_type != "variable")
        <p class="mb-0"><strong>{{__("SKU: ")}}</strong> {{$row->sku}}</p>
    @endif
    @if($row->quantity and in_array($row->product_type,["simple","variable"]) and $row->is_manage_stock())
        <p class="mb-0"><strong>{{__("Quantity: ")}}</strong> {{$row->remain_stock}} {{__("in stock")}}</p>
    @endif
    @if(!empty($row->categories))
        <p class="categories mb-0">
            <strong> {{__("Categories:")}}</strong>
            @foreach($row->categories as $k=>$category)
                @if($k) ,
                @endif
                <a class="c-main" href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
            @endforeach
        </p>
    @endif
    @if(!empty($row->tags))
        <p class="tags mb-0">
            <strong> {{ __("Tags") }}</strong>
            @foreach($row->tags as $k=>$category)
                @if($k) , @endif
                <a class="initial" href="{{ route('product.index')."?tag=$category->slug" }}">{{$category->name}}</a>
            @endforeach
        </p>
    @endif
</div>
