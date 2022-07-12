<div class="product-policies">
    @php $policies = setting_item_with_lang("product_policies"); @endphp
    @if(!empty($policies))
        @foreach(json_decode($policies) as $item)
            <h5 class="fz16">{{__($item->title)}}</h5>
            <div class="description mb-3 fz14">{{__($item->content)}}</div>
        @endforeach
    @endif
</div>
