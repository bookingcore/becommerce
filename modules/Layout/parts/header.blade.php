<div class="bravo-header">
    @if(!empty($header_style) and view()->exists('Layout::headers.'.$header_style))
        @include('Layout::headers.'.$header_style)
    @else
        @include('Layout::headers.default')
    @endif
</div>
