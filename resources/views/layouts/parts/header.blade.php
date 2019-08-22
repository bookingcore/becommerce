<div class="bravo-header">
    @if(!empty($header_style) and view()->exists('layouts.headers.'.$header_style))
        @include('layouts.headers.'.$header_style)
    @else
        @include('layouts.headers.default')
    @endif
</div>