<?php

use Modules\Product\Models\ProductAttr;
$attr = ProductAttr::where('id',$widget['attr']??0)->with(['terms'=>function($query){
    $query->with('translation')->withCount('product');
}])->first();
if(!$attr or empty($attr->terms)) return;
;?>
<div class="terms_condition_widget filter_sidebar">
    <h4 class="title">{{__($widget['title'])}}</h4>
    <div class="widget_list">
        <ul>
        @foreach($attr->terms as $term)
            @php($translate = $term->translate(app()->getLocale()))
            <li><a href="{{request()->fullUrlWithQuery(['terms[]'=>$term->id])}}"><span class="mr10"></span>{{$translate->name}} <span class="float-end">{{$term->product_count}}</span></a></li>
        @endforeach
        </ul>
    </div>
    <hr>
</div>
