<div class="zm-block--about-two-columns {{ $style }} md:mb-14 mb-10">
    <div class="container max-w-[1192px] mx-auto">
        @if($title)
            <h2 class="text-[28px] font-medium lg:mb-7 mb-5">{{ $title }}</h2>
        @endif
        @if($list_items)
            <div class="grid md:grid-cols-3 grid-cols-1 md:gap-7 gap-0">
                @foreach($list_items as $key => $val)
                    <div class="text-center md:mb-0 mb-6">
                        @if($val['icon_image'])
                            <img src="{{ get_file_url($val['icon_image'] ?? '', 'full') }}" class="mb-5 mx-auto" alt="{{ $val['name'] }}" />
                        @endif
                        <h3 class="text-lg mb-2 font-medium">{{ $val['name'] }}</h3>
                        <p class="text-[15px] color-[#626974]">{{ $val['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
