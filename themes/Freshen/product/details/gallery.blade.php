@if($row->getGallery())
    <div class="bc-product_thumbnail d-none" data-vertical="true">
        <figure>
            <div class="bc-wrapper position-relative">
                <div class="bc-product_gallery" data-arrow="true">
                    @foreach($row->getGallery() as $key=>$item)
                        <div class="item item-{{$key}}">
                            <img src="{{$item['large']}}" alt="{{ __("Gallery") }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </figure>
        <div class="bc-product_variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
            @foreach($row->getGallery() as $key=>$item)
                <div class="item item-{{$key}}">
                    <img src="{{$item['thumb']}}" alt="{{ __("Gallery") }}">
                </div>
            @endforeach
        </div>
    </div>
    <div class="single_product_grid">
        <div class="single_product_slider">
            @foreach($row->getGallery() as $key=>$item)
                <div class="item">
                    <div class="sps_content">
                        <div class="thumb">
                            <div class="single_product">
                                <div class="single_item">
                                    <div class="thumb">
                                        <img class="img-fluid" src="{{$item['thumb']}}" alt="{{ __("Gallery") }}">
                                    </div>
                                </div>
                                <a class="product_popup popup-img" href="{{$item['large']}}"><span class="flaticon-search"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="gallery-carousel-custom-dots" class="owl-dots">
            @foreach($row->getGallery() as $key=>$item)
                <div class="owl-dot"><span style="background-image: url('{{$item['thumb']}}')"></span></div>
            @endforeach
        </div>
    </div>
@endif
