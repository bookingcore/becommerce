<?php
$recent_posts = \Modules\News\Models\News::search()->take(5)->orderByDesc('id')->get();
if(!count($recent_posts)) return;
?>
<aside class="widget widget--blog widget--recent-post">
    <h3 class="widget__title">{{__('Recent Posts')}}</h3>
    <div class="widget__content">
        @foreach($recent_posts as $post)
{{--            @dump($post)--}}
            <?php $translation = $post->translate() ?>
            <div class="post-content d-flex mb-15">
                <div class="post-thumb mr-15">
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
