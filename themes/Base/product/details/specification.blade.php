<div class="bc-product_specification mb-2">
    <a class="report c-main" href="#">{{ __('Report Abuse') }}</a>
    @if($row->sku)
        <p class="mb-0"><strong>{{__("SKU: ")}}</strong> {{$row->sku}}</p>
    @endif
    @if(!empty($row->categories))
        <p class="categories mb-0">
            <strong> {{__("Categories:")}}</strong>
            @foreach($row->categories as $k=>$category)
                @if($k) ,
                @endif
                <a href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
            @endforeach
        </p>
    @endif
    @if(!empty($row->tags))
        <p class="tags mb-0">
            <strong> {{ __("Tags") }}</strong>
            @foreach($row->tags as $k=>$category)
                @if($k) , @endif
                <a href="{{ route('product.index')."?tag=$category->slug" }}">{{$category->name}}</a>
            @endforeach
        </p>
    @endif
</div>
