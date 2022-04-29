<?php
use Modules\Product\Models\ProductTag;
$tags = ProductTag::withCount('product')->orderBy('product_count','desc')->limit(9)->with(['translation'])->get();
if(!$tags) return;
;?>

@if(!empty($tags))
<div class="blog_tag_widget filter_sidebar mb30">
    <h4 class="title">{{__('Trending Tags')}}</h4>
    <ul class="tag_list">
        @foreach($tags as $tag)
            @php($translate = $tag->translate(app()->getLocale()))
            <li class="list-inline-item"><a href="{{request()->fullUrlWithQuery(['tag'=>$tag->slug])}}">{{$translate->name}}</a></li>
        @endforeach
    </ul>
</div>
@endif
