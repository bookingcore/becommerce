@if(!empty($rows->count()))
    <div class="axtronic-slider-best mb-5" style="background-image: url('{{ theme_url('Axtronic/images/bg-bestseller.jpg') }}')">
        <div class="container">
            <div class="product-box-title">
                <h2 class="heading-title"><span>Best</span> Selling</h2>
            </div>
            <div class="axtronic-slider-content">
                <div class="product-slider-bestselling product-slider swiper-container">
                    <div class="swiper-wrapper">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="swiper-slide">
                                    @include('product.search.loop')
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
@endif
