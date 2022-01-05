@if(!empty($rows->count()))
    <div class="ps-deal-of-day pt-5 pb-5 mt-5 mb-5">
        <div class="ps-container">
            <div class="ps-section__header">
                <div class="ps-block--countdown-deal">
                    <div class="ps-block__left">
                        <h3>{{ $title }}</h3>
                    </div>
                </div>
                <a href="{{ !empty($link_view_all) ? $link_view_all : route("product.index") }}">{{ __("View all") }}</a>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            @include('product.search.loop-item',['class'=>'ps-product--inner'])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
