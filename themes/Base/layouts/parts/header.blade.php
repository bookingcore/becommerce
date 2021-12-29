<div class="bravo-header">
    @if(!empty($page_style) and view()->exists('layouts.parts.header.headers.style_'.$page_style->header))
        @include('layouts.parts.headers.style_'.$page_style->header)
    @else
        @include('layouts.parts.headers.style_1')
    @endif
</div>
