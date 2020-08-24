<div class="bravo-header">
    @if(!empty($page_style) and view()->exists('Layout::headers.style_'.$page_style->header))
        @include('Layout::headers.style_'.$page_style->header)
    @else
        @include('Layout::headers.default')
    @endif
</div>
