<div class="zm-block--about-editor">
    <div class="container max-w-[1192px] mx-auto">
        @if($title)
            <h2 class="text-[28px] font-medium lg:mb-7 mb-5">{{ $title }}</h2>
        @endif
        <div class="lg:mb-8 mb-6">
            {!! $content !!}
        </div>
        @if($our_mission || $our_vision)
            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-7 gap-0">
                @if($our_mission)
                    <div class="md:mb-0 mb-7">
                        <h3 class="text-xl font-medium md:mb-6 mb-3">{{ __("Our Mission") }}</h3>
                        <div>
                            {!! $our_mission !!}
                        </div>
                    </div>
                @endif
                @if($our_vision)
                    <div>
                        <h3 class="text-xl font-medium md:mb-6 mb-3">{{ __("Our Vision") }}</h3>
                        <div>
                            {!! $our_vision !!}
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
