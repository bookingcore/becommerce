@php $languages = \Modules\Language\Models\Language::getActive();
if(!isset($current_cat)) $current_cat = null;
$header_style = isset($header_style) && !empty($header_style) ? $header_style : 'normal';
@endphp

<header id="masthead" class="header {{ 'header-'.$header_style }}">
    @if(Auth::id())
        @include('layouts.parts.header.topbar')
    @endif
    <div class="{{ ($header_style == 'style_2') ? 'container' : 'container-fluid' }} ">
        @if($header_style == 'style_1')
            @include('layouts.parts.header.style_1')
        @elseif($header_style =='style_2')
            @include('layouts.parts.header.style_2')
        @else
            @include('layouts.parts.header.normal')
        @endif
    </div>
</header>
