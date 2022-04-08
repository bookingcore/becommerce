<?php
$recent_posts = \Modules\News\Models\News::search()->take(5)->orderByDesc('id')->get();
if(!count($recent_posts)) return;
?>
<div class="sidebar_feature_listing">
    <h4 class="title">{{__('Recent Posts')}}</h4>
    @foreach($recent_posts as $post)
        <?php $translation = $post->translate() ?>
        <div class="d-flex">
            <div class="flex-shrink-0">
                {!! get_image_tag($post->image_id,'thumb',['class'=>'align-self-start mr-3']) !!}
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="post_title"><a class="post_title" href="{{$post->getDetailUrl()}}">{{ \Illuminate\Support\Str::words(strip_tags($translation->title), 5, '...') }}</a></h5>
                <a class="date" href="{{$post->getDetailUrl()}}">{{ display_date($post->created_at) }}</a>
            </div>
        </div>
    @endforeach
    <hr>
</div>
