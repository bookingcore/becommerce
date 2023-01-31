<div class="product-policies">
    @php $policies = setting_item_with_lang("product_policies"); @endphp
    @if(!empty($policies))
        @foreach(json_decode($policies) as $item)
            <h5>{{__($item->title)}}</h5>
            <div class="description">{{__($item->content)}}</div>
        @endforeach
    @endif
</div>
