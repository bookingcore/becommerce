<div class="zm-block--about-two-columns">
    <div class="container max-w-[1192px] mx-auto">
        <div class="grid md:grid-cols-2 grid-cols-1">
            <div class="max-w-[445px]">
                @if($title)
                    <h2 class="text-[28px] font-medium lg:mb-7 mb-5">{{ $title }}</h2>
                @endif
            </div>
            <div>
                {!! $content !!}
                @if($button_url && $button_name)
                    <a class="" href="{{ $button_url }}">{{ $button_name }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
