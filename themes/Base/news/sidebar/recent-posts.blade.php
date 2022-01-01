<?php
$recent_posts = \Modules\News\Models\News::search()->take(5)->orderByDesc('id')->get();
if(!count($recent_posts)) return;
?>
<aside class="widget widget--blog widget--recent-post">
    <h3 class="widget__title">{{__('Recent Posts')}}</h3>
    <div class="widget__content">
        @foreach($recent_posts as $post)
            <?php $translation = $post->translate() ?>
            <a href="{{$post->getDetailUrl()}}">{{$translation->title}}</a>
        @endforeach
    </div>
</aside>
