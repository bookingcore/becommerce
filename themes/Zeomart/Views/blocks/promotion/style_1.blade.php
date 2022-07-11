@if(!empty($list_items))
    <section class="bc-promotions py-10">
        <div class="max-w-7xl m-auto">
            <div class="flex -ml-3.5 -mr-3.5">
                @foreach($list_items as $key => $item)
                    <div class="w-2/6 pl-3.5 pr-3.5">
                        <div class="relative">
                            <div class="thumb">
                                <img src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="absolute left-[40px] top-[60px]">
                                <p class="text-[15px] text-[#0053F6] mb-2">{!! $item['sub_title'] ?? '' !!}</p>
                                <h2 class="text-[26px] font-[500] mb-2">{!! $item['title'] ?? '' !!}</h2>
                                <a href="{{ $item['link'] ?? '' }}" class="text-[15px] font-[500] relative pb-1 before:content-[''] before:border-b-2 before:w-[35px] before:block before:absolute before:bottom-0 before:left-0 before:border-[#041E42]">{{ __("SHOP NOW") }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

