<div class="zm-block--list-offices">
    <div class="container">
        <div class="flex flex-wrap justify-between">
            <div class="md:w-1/2 w-full max-w-[448px] md:pr-7 pr-0 mb-7">
                @if($title)
                    <h2 class="font-medium text-[28px] mb-5">{{ $title }}</h2>
                @endif
                @if($desc)
                    <div class="desc text-base">{{ $desc }}</div>
                @endif
            </div>
            <div class="md:w-1/2 w-full">
                @if($list_offices)
                <div class="grid grid-cols-2 md:gap-7 gap-5">
                    @foreach($list_offices as $key => $val)
                        <div class="md:pb-8 pb-5">
                            <div class="text-lg font-medium mb-2">{{ $val['name'] }}</div>
                            <div class="text-base leading-7 mb-2 max-w-[270px]">
                                {{ $val['address'] }}
                                @if($val['phone'])
                                    <br><a href="tel:{{ $val['phone'] }}" target="_blank">{{$val['phone']}}</a>
                                @endif
                                @if($val['email'])
                                    <br><a href="mailto:{{ $val['email'] }}" target="_blank">{{$val['email']}}</a>
                                @endif
                            </div>
                            @if($val['map_url'])
                                <a class="text-[15px] font-medium inline-block group" href="mailto:{{ $val['map_url'] }}" target="_blank">
                                    {{ __("See Map") }}
                                    <span class="w-8 h-0.5 block mt-1 bg-[#041E42] duration-300 group-hover:w-full"></span>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
