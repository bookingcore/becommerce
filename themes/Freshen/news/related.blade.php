<?php
if(!$related_post->count())
    return;
?>
<h3 class="mb30 mt50">{{__('Related Articles')}}</h3>
<div class="bsp_grid3_slider">
    @foreach($related_post as $post)
        <div class="item">
            @include('news.loop',['row'=>$post])
        </div>
    @endforeach
</div>
