@if(count($row->up_sell))
    <div class="axtronic-products-related">
        <h3 class="related-title mt-5 mb-4 pb-2 border-bottom-1">{{ __('You may also like') }}</h3>
        <div class="axtronic-swiper-relate  swiper-container">
            <div class="swiper-wrapper">
                @foreach($row->up_sell as $row)
                    <div class="swiper-slide">
                        @include('product.search.loop')
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
@endif
