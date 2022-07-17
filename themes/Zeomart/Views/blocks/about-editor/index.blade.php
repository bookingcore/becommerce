<div class="zm-about-editor lg:mb-14 mb-8">
    <div class="container max-w-[1192px] mx-auto">
        @if($title)
            <h2 class="text-[28px] font-medium lg:mb-7 mb-5">{{ $title }}</h2>
        @endif
        <div class="lg:mb-8 mb-6">
            {!! $content !!}
        </div>
        @if($our_mission || $our_vision)
            <div class="flex flex-wrap">
                @if($our_mission)
                    <div class="w-1/2 w-full pr-7 mb-7">
                        <h3 class="text-xl font-medium mb-6">{{ __("Our Mission") }}</h3>
                        <div>
                            {!! $our_mission !!}
                        </div>
                    </div>
                @endif
                @if($our_vision)
                    <div class="w-1/2 w-full mb-7">
                        <h3 class="text-xl font-medium mb-6">{{ __("Our Vision") }}</h3>
                        <div>
                            {!! $our_vision !!}
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
