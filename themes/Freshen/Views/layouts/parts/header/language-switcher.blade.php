@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
    <li class="list-inline-item">
        <div class="htlw_form_select">
            <span class="stts">{{ __('Language') }}</span>
            <select class="custom_select_dd bc-language-sw">
                @foreach($languages as $language)
                    <option value="{{get_lang_switcher_url($language->locale)}}" @if($locale == $language->locale) selected @endif>
                        {{$language->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </li>
@endif
