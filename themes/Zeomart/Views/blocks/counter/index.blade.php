<div class="zm-block--counter">
    <div class="container max-w-[1192px] mx-auto">
        @if($title)
            <h2 class="text-[28px] font-medium lg:mb-7 mb-5">{{ $title }}</h2>
        @endif
        @if($list_items)
            <div class="grid md:grid-cols-4 sm:grid-cols-2 md:gap-7 gap-5">
                @foreach($list_items as $key => $val)
                    <div class="counter-item">
                        <div class="text-center text-5xl leading-[1.45] font-medium ">
                            <span class="counter-number">{{ $val['number'] }}</span>{{ $val['unit'] }}
                        </div>
                        <div class="text-center text-base">{{ $val['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
