<div class="bc-list-categories py-10">
    <div class="max-w-7xl m-auto">
        <div class="mb-8 flex justify-between items-center">
            <h3 class="font-[500] text-3xl">{{ $title }}</h3>
            <a class="font-[500] text-base relative pb-1 before:content-[''] before:border-b-2 before:w-[35px] before:block before:absolute before:bottom-0 before:left-0 before:border-[#041E42]" href="{{ route('product.index') }}">
                {{ __("View All Categories") }}
            </a>
        </div>
        <div class="bc-content">
            <div class="bc-carousel owl-theme owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="1" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="7" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach($list_items as $k=>$item)
                    @php $image_url = get_file_url($item['image_id'] ?? "", 'full'); @endphp
                    @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                        @php
                            $translate = $item_cat->translate(app()->getLocale());
                            $page_search = $item_cat->getDetailUrl();
                        @endphp
                        <div class="item flex items-center justify-center">
                            <a href="{{ $page_search }}">
                                <div class="iconbox">
                                    <div class="icon w-[150px] h-[150px] bg-[#F3F5F6] flex items-center justify-center rounded-full">
                                        @if(!empty($image_url))
                                            <img src="{{$image_url}}" class="!w-auto" alt="{{ $translate->name }}">
                                        @endif
                                    </div>
                                    <div class="text-center mt-5">
                                        <h5 class="text-base font-[500]">{{ $translate->name }}</h5>
                                        <div class="text-[#626974]">999 items</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
