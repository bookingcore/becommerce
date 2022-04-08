@foreach(setting_item_with_lang_arr('news_sidebar') as $widget)
    @if(!empty($widget['type']))
        @switch($widget['type'])
            @case ('search_form')
                <div class="sidebar_search_widget">
                    <form action="{{route('news')}}" class="blog_search_widget">
                        <div class="input-group">
                            <input type="text" class="form-control" name="s" value="{{request('s')}}" placeholder="{{__('Search')}}" >
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><span class="fa fa-search"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
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
