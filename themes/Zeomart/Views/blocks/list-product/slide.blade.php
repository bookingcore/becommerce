@if(!empty($rows->count()))
    <div class="bc-list-products py-10">
        <div class="max-w-7xl m-auto">
            <div class="mb-8">
                <h3 class="font-[500] text-3xl">{{ $title }}</h3>
            </div>
            <div class="bc-content">
                <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            @include('product.search.loop',['class'=>'ml-1'])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
