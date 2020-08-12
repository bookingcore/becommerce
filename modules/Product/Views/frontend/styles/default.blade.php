<div class="bravo_detail_product">
    <div class="bravo-container martfury-container">
        <div class="row">
            <div class="col-md-9 col-product-info">
                <div class="row">
                    <div class="col-md-5 col-product-gallery">
                        @include('Product::frontend.details.gallery')
                    </div>
                    <div class="col-md-7 col-product-meta">
                        @include('Product::frontend.details.meta')
                    </div>
                </div>
                <div class="py-5"></div>
                @include('Product::frontend.details.tabs')
            </div>
            <div class="col-md-3 col-product-sidebar">
                @include('Product::frontend.details.sidebar.shipping')
                @include('Product::frontend.details.sidebar.custom-html')
                @include('Product::frontend.details.sidebar.same-brand')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('Product::frontend.details.related')
            </div>
        </div>
    </div>
</div>
