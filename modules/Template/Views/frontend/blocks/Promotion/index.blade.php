@if(!empty($style) && $style > 0)
    @include("Template::frontend.blocks.Promotion.styles.style-{$style}")
@else
    @include('Template::frontend.blocks.Promotion.styles.style-default')
@endif
