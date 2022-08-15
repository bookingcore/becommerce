@foreach(setting_item_with_lang_arr('news_sidebar') as $widget)
    @if(!empty($widget['type']))
        @switch($widget['type'])
            @case ('search_form')
                <aside class="widget widget-search">
                    <form class="bc-form-widget-search" action="{{route('news')}}" method="get">
                        <div class="input-group border">
                            <input class="form-control blog-search__input border-0" type="text" name="s" value="{{request('s')}}" placeholder="{{__('Search...')}}">
                            <button class="blog-search__btn  border-0 bg-transparent"><i class="fa fa-search"></i></button>
                        </div>
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
