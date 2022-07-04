<?php $cross_sells =  $cart->getCrossSells();?>
@if(count($cross_sells))
    <div class="bc-products-related">
        <h3 class="related-title my-4 pb-2 border-bottom-1">{{ __('You may be interested in:') }}</h3>
        <div class="row" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
            @foreach($cross_sells as $row)
                <div class="col-sm-4 mb-3">
                    @include('product.search.loop')
                </div>
            @endforeach
        </div>
    </div>
@endif
