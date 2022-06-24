@foreach(setting_item_with_lang_arr('news_sidebar') as $widget)
    @if(!empty($widget['type']))
        @switch($widget['type'])
            @case ('search_form')
                <aside class="widget widget-search">
                    <form class="axtronic-form-widget-search" action="{{route('news')}}" method="get">
                        <input class="form-control pr-5" type="text" name="s" value="{{request('s')}}" placeholder="{{__('Search...')}}">
                        <button><i class="axtronic-icon-search"></i></button>
                    </form>
                </aside>
            @break
            @case('category')
                @include('news.sidebar.category')
            @break
            @case('recent_news')
                @include('news.sidebar.recent_news')
            @break
            @case('tag')
                @include('news.sidebar.tag')
            @break
            @case('content_text')
                <aside class="widget widget--blog">
                    <h3 class="widget__title">{{$widget['title'] ?? ''}}</h3>
                    <div class="widget__content">
                        {!! nl2br(strip_tags($widget['title'])) !!}
                    </div>
                </aside>
            @break
        @endswitch
    @endif
@endforeach
