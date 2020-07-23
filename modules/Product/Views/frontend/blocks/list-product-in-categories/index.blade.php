<div class="bravo_ProductInCategories">
    <div class="martfury-container">
        <div class="mf-products-tabs">
            <div class="tabs-header">
                <h2><span class="cat-title">{{ $title }}</span></h2>
                <div class="tabs-header-nav">
                    <a class="link" href="{{ route("product.index") }}">{{__('View All')}}</a></div>
            </div>
            <div class="tabs-content">
                <ul class="products list-unstyled">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            @include('Product::frontend.layouts.product')
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
