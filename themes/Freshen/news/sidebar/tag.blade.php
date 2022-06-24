<?php
$tags = \Modules\News\Models\Tag::search()->withCount(['news'])->orderByDesc('news_count')->take(9)->get();
if(!count($tags)) return;
?>
<div class="blog_tag_widget">
    <h4 class="title">{{ $widget['title'] ??  __('Trending Tags') }}</h4>
    <ul class="tag_list">
        @foreach($tags as $tag)

            <li class="list-inline-item"><a href="{{$tag->getDetailUrl()}}">{{$tag->name}}</a></li>
        @endforeach
    </ul>
</div>
