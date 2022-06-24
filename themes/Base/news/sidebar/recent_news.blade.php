<?php
$recent_posts = \Modules\News\Models\News::search()->take(5)->orderByDesc('id')->get();
if(!count($recent_posts)) return;
?>
<aside class="widget widget-recent-post">
    <h3 class="widget_title">{{__('Recent Posts')}}</h3>
    <div class="widget_content">
        @foreach($recent_posts as $post)
            <?php $translation = $post->translate() ?>
            <div class="post-content d-flex mb-3 pb-3">
                <div class="post-thumb">
                    <img src="{{ get_file_url($post->image_id) }}" alt="{{$translation->title}}">
                </div>
                <div class="post-title">
                    <a class="c-333333 fs-15" href="{{$post->getDetailUrl()}}">{{ \Illuminate\Support\Str::words(strip_tags($translation->title), 8, '...') }}</a>
                    <div class="op-07 fs-14">{{ display_date($post->created_at) }}</div>
                </div>
            </div>
        @endforeach
    </div>
</aside>
