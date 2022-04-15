@php $languages = \Modules\Language\Models\Language::getActive();
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
@endphp
<header id="masthead" class="header {{ (!empty($header_style) and $header_style=='transparent')? " header-".$header_style : "header-normal" }}">
    @if(!empty($header_style) and $header_style=='transparent')
        @include('layouts.parts.header.style_2')
    @else
        @include('layouts.parts.header.style_1')
    @endif
</header>
