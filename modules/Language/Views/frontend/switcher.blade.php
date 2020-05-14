@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
{{--Multi Language--}}
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
    <div class="header-bar topbar">
        <div id="lang_sel">
            <ul>
                <li>
                    @foreach($languages as $language)
                        @if($locale == $language->locale)
                            <a href="#" data-toggle="dropdown" class="is_login">
                                @if($language->flag)
                                    <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                                @endif
                                {{$language->name}}
                            </a>
                        @endif
                    @endforeach
                    <ul>
                        @foreach($languages as $language)
                            @if($locale != $language->locale)
                                <li>
                                    <a href="{{get_lang_switcher_url($language->locale)}}" class="is_login">
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
            </ul>
        </div>
    </div>
@endif
{{--End Multi language--}}
