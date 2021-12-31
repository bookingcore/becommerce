@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
    <div class="ps-dropdown language">
        @foreach($languages as $language)
            @if($locale == $language->locale)
                <a href="#">
                    @if($language->flag)
                        <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                    @endif
                    {{$language->name}}
                </a>
            @endif
        @endforeach
        <ul class="ps-dropdown-menu">
            @foreach($languages as $language)
                @if($locale != $language->locale)
                    <li>
                        <a href="{{get_lang_switcher_url($language->locale)}}" class="d-flex">
                            @if($language->flag)
                                <span class="flag-icon flag-icon-{{$language->flag}} mr-2"></span>
                            @endif
                            {{$language->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif