@if($products_related->count())
    <div class="axtronic-products-related">
        <h3 class="related-title mt-5 mb-4 pb-2 border-bottom-1">{{ __('Related products') }}</h3>
        <div class="axtronic-swiper-relate product-slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($products_related as $row)
                    <div class="swiper-slide">
                        @include('product.search.loop')
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
@endif
