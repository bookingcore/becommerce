@php
    $user = Auth::user();
    $languages = \Modules\Language\Models\Language::getActive();
@endphp

@if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
    <div class="language-navigation" id="language-navs" >
        <ul class="nav nav-tabs nav nav-tabs flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" role="tablist" >
            @foreach($languages as $language)
                <li class="nav-item mr-2">
                    <a class="nav-link nav-link active inline-flex py-4 px-6 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 @if(request()->lang == $language->locale or (!request()->lang && $language->locale == setting_item('site_locale'))) active border-blue-600 text-blue-600 bg-white @endif" href="{{add_query_arg(['lang'=>$language->locale])}}">
                        @if($language->flag)
                            <span class="mr-4 flag-icon flag-icon-{{$language->flag}}"></span>
                        @endif
                        {{$language->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @if(request()->query('lang'))
        <input type="hidden" name="lang" value="{{request()->query('lang')}}">
    @endif
@endif
