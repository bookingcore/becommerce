@if(!empty($rows->count()))
    <div class="bravo_product-list style-{{$style_list}}">
        <div class="martfury-container">
            @if($style_list == 1)
                @include('Product::frontend.blocks.list-space.style-sliders')
            @else
                <!--Continue-->
                @include('Product::frontend.blocks.list-space.style-normal')
            @endif
        </div>
    </div>
@endif
