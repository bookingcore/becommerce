<?php
$tags = \Modules\News\Models\Tag::search()->withCount(['news'])->orderByDesc('news_count')->take(9)->get();
if(!count($tags)) return;
?>
<aside class="widget widget-tags">
    <h3 class="widget_title">{{__('Tags')}}</h3>
    <div class="widget_content">
        @foreach($tags as $tag)
            <a href="{{$tag->getDetailUrl()}}">{{$tag->name}}</a>
        @endforeach
    </div>
</aside>
