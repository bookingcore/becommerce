@if(!empty($rows->count()))
    <div class="bc-list-products mb-5">
        <div class="container">
            <div class="mb-4">
                <h3 class="fs-24 mb-1">{{ $title }}</h3>
                <span class="fs-16">{{ $sub_title }}</span>
            </div>
            <div class="bc-content">
                <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            @include('product.search.loop')
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
