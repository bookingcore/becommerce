@php $languages = \Modules\Language\Models\Language::getActive(); @endphp
<header id="masthead" class="header">
    @include('layouts.parts.header.topbar')
    <div class="container">
        <div class="header-wrap">
            <div class="site-branding">
                a
            </div>
            <div class="site-navigation">
                @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
            </div>
        </div>
    </div>
</header>
