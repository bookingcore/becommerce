@if($row->getGallery())
    <div class="bc-product_thumbnail" data-vertical="true">
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
@endif
