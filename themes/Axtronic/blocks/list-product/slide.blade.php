@if(!empty($rows->count()))
    <div class="axtronic-slider-products mb-5">
        <div class="container">
            <div class="product-box-title">
                <h2 class="heading-title">{{ $title }}</h2>
                <ul class="list-unstyled list-category-name">
                    <li><a href="#" class="button">Soundbar</a></li>
                    <li><a href="#" class="button">Bluetooth</a></li>
                    <li><a href="#" class="button">Headphone</a></li>
                    <li><a href="#" class="button">Earphone</a></li>
                    <li><a href="#" class="button">Wireless</a></li>
                    <li><a href="#" class="button">See all</a></li>
                </ul>
            </div>
            <div class="axtronic-slider-content">
                <div class="product-slider swiper-container">
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
