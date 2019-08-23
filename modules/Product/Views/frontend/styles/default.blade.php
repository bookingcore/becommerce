@include('layouts.parts.bc')
<div class="bravo_detail_product">
    <div class="bravo-container container">
        <div class="row">
            <div class="col-md-9 col-product-info" >
                <div class="row">
                    <div class="col-md-6 col-product-gallery">
                        @include('Product::frontend.details.gallery')
                    </div>
                    <div class="col-md-6 col-product-meta">
                        @include('Product::frontend.details.meta')
                    </div>
                </div>
                @include('Product::frontend.details.tabs')
                @include('Product::frontend.details.related')
            </div>
            <div class="col-md-3 col-product-sidebar">

            </div>
        </div>
    </div>
</div>