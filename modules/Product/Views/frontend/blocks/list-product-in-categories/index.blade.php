<div class="bravo_ProductInCategories">
    @if(!empty($style == 1))
        @include('Product::frontend.blocks.list-product-in-categories.style-1')
    @else
        @include('Product::frontend.blocks.list-product-in-categories.style-default')
    @endif
</div>
