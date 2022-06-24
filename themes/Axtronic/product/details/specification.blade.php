@if($row->quantity and in_array($row->product_type,["simple","variable"]) and $row->is_manage_stock)
    <p class="mb-0"><span>{{__("Quantity: ")}}</span> {{$row->quantity}} {{__("in stock")}}</p>
@endif

<div class="axtronic-product_specification axtronic-product_meta ">
    @if(!empty($row->tags))
        <p class="tags mb-0">
            <span> {{ __("Tags") }}: </span>
            @foreach($row->tags as $k=>$tag)
                @if($k) , @endif
                <a class="initial" href="{{ route('product.index')."?tag=$tag->slug" }}">{{$tag->name}}</a>
            @endforeach
        </p>
    @endif
</div>
