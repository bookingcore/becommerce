@if(!empty($rows->count()))
    <div class="bc-deal-of-day pt-5 pb-5 mt-5 mb-5">
        <div class="bc-container">
            <div class="bc-section__header">
                <div class="bc-block--countdown-deal">
                    <div class="bc-block__left">
                        <h3>{{ $title }}</h3>
                    </div>
                </div>
                <a href="{{ !empty($link_view_all) ? $link_view_all : route("product.index") }}">{{ __("View all") }}</a>
            </div>
            <div class="bc-section__content">
                <div class="bc-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            @include('product.search.loop-item',['class'=>'bc-product--inner'])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
