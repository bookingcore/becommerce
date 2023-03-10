@if(!empty($rows->count()))
    <div class="zm-list-products py-10">
        <div class="container">
            <div class="mb-8 flex justify-between items-center">
                <h3 class="font-[500] text-3xl">{{ $title }}</h3>
                <a class="font-[500] text-base relative pb-1 before:content-[''] before:border-b-2 before:w-[35px] before:block before:absolute before:bottom-0 before:left-0 before:border-[#041E42]" href="{{ route('product.index') }}">
                    {{ __("View All") }}
                </a>
            </div>
            <div class="bc-content">
                <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            <div class="p-5 border-slate-200 border -mr-[1px] border-solid">
                                @include('product.search.loop')
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
