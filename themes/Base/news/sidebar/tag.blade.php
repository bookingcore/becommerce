<?php
$tags = \Modules\News\Models\Tag::search()->withCount(['news'])->orderByDesc('news_count')->take(9)->get();
if(!count($tags)) return;
?>
<aside class="widget widget--blog widget--tags">
    <h3 class="widget__title">{{__('Popular Tags')}}</h3>
    <div class="widget__content">
        @foreach($tags as $tag)
            <a href="{{$tag->getDetailUrl()}}">{{$tag->name}}</a>
        @endforeach
    </div>
</aside>
