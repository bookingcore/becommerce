<div class="wcmp-product-policies">
    @php $policies = setting_item_with_lang("product_policies"); @endphp
    @if(!empty($policies))
        @foreach(json_decode($policies) as $item)
            <h2 class="wcmp_policies_heading heading">{{__($item->title)}}</h2>
            <div class="wcmp_policies_description description">{{__($item->content)}}</div>
        @endforeach
    @endif
</div>
