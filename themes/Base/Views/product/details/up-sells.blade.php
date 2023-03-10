@if(count($row->up_sell))
    <div class="bc-products-related">
        <h3 class="related-title my-4 pb-2 border-bottom-1">{{ __('You may also like') }}</h3>
        <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
            @foreach($row->up_sell as $row)
                @include('product.search.loop')
            @endforeach
        </div>
    </div>
@endif
