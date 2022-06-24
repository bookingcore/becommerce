@if($row->getGallery())
    <div class="axtronic-product_thumbnail" data-vertical="true">
        <figure class="swiper swiper-product-gallery">
            <div class="axtronic-wrapper swiper-wrapper">
                @foreach($row->getGallery() as $key=>$item)
                    <div class="swiper-slide item-{{$key}}">
                        <img src="{{$item['large']}}" alt="{{ __("Gallery") }}">
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </figure>
        <div class="axtronic-product_variants swiper" thumbsSlider="">
            <div class="swiper-wrapper">
                @foreach($row->getGallery() as $key=>$item)
                    <div class="swiper-slide item-{{$key}}">
                        <img src="{{$item['thumb']}}" alt="{{ __("Gallery") }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
