<div class="zm-block--counter">
    <div class="container max-w-[1192px] mx-auto">
        @if($title)
            <h2 class="text-[28px] font-medium lg:mb-7 mb-5">{{ $title }}</h2>
        @endif
        @if($list_items)
            <div class="grid md:grid-cols-4 sm:grid-cols-2 md:gap-7 gap-5">
                @foreach($list_items as $key => $val)
                    <div class="counter-item be-counter">
                        <div class="text-center text-5xl leading-[1.45] font-medium ">
                            <span class="counter-number" data-speed="3000" data-stop="{{ $val['number'] }}">0</span>{{ $val['unit'] }}
                        </div>
                        <div class="text-center text-base">{{ $val['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
