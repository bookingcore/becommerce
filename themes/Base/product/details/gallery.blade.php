@if($row->getGallery())
    <div class="ps-product__thumbnail" data-vertical="true">
        <figure>
            <div class="ps-wrapper">
                <div class="ps-product__gallery" data-arrow="true">
                    @foreach($row->getGallery() as $key=>$item)
                        <div class="item">
                            <a href="{{$item['thumb']}}">
                                <img src="{{$item['large']}}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </figure>
        <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
            @foreach($row->getGallery() as $key=>$item)
                <div class="item">
                    <img src="{{$item['thumb']}}" alt="">
                </div>
            @endforeach
        </div>
    </div>
@endif