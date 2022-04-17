@if(!empty($tags_trending))
<div class="blog_tag_widget filter_sidebar mb30">
    <h4 class="title">{{__('Trending Tags')}}</h4>
    <ul class="tag_list">
        @foreach($tags_trending as $tag)
            @php($translate = $tag->translate(app()->getLocale()))
            <li class="list-inline-item"><a href="#">{{$translate->name}}</a></li>
        @endforeach
    </ul>
</div>
@endif
