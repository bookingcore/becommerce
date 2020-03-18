<div id="recent-posts-2" class="widget widget_recent_entries">
    <h4 class="widget-title">{{ $item->title }}</h4>
    <ul>
        @php $list_blog = $model_news->with(['getCategory','translations'])->orderBy('id','desc')->paginate(5) @endphp
        @if($list_blog)
            @foreach($list_blog as $blog)
                @php $translation = $blog->translateOrOrigin(app()->getLocale()) @endphp
                <li>
                    @if(!empty($blog->getCategory->name))
                        <a href="{{ $blog->getDetailUrl(app()->getLocale()) }}">{{$translation->title}}</a>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</div>
