<?php $cross_sells =  $cart->getCrossSells();?>
@if(count($cross_sells))
    <div class="axtronic-products-related">
        <h3 class="related-title mb-4 pb-2 border-bottom-1">{{ __('You may also like') }}</h3>
        <div class="axtronic-swiper-relate  swiper-container">
            <div class="swiper-wrapper">
                @foreach($cross_sells as $row)
                    <div class="swiper-slide">
                        @include('product.search.loop')
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
@endif
