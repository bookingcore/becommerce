@php $languages = \Modules\Language\Models\Language::getActive();
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
@endphp

<header id="masthead" class="header {{ isset($header_style) && !empty($header_style) ? 'header-'.$header_style : 'header-normal' }}">
    @if(!empty($header_style) and $header_style == 'style_1')
        @include('layouts.parts.header.style_1')
    @elseif(!empty($header_style) and $header_style=='style_2')
        @include('layouts.parts.header.style_2')
    @else
        @include('layouts.parts.header.normal')
    @endif
</header>
