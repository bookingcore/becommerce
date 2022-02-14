@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
{{--Multi Language--}}
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
    <li class="dropdown">
        @foreach($languages as $language)
            @if($locale == $language->locale)
                <a href="#" data-bs-toggle="dropdown" class="is_login nav-link text-white">
                    @if($language->flag)
                        <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                    @endif
                    {{$language->name}}
                   <i class="axtronic-icon-angle-down"></i>
                </a>
            @endif
        @endforeach
        <ul class="dropdown-menu text-left">
            @foreach($languages as $language)
                @if($locale != $language->locale)
                    <li>
                        <a href="{{get_lang_switcher_url($language->locale)}}" class="dropdown-item">
                            @if($language->flag)
                                <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                            @endif
                            {{$language->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@endif
{{--End Multi language--}}
