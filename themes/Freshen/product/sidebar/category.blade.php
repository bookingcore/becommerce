<?php
use Modules\Product\Models\ProductCategory;
$categories = ProductCategory::where('status','publish')->with(['translation'])->limit(999)->
withDepth()->having('depth', '==', 1)
    ->withCount(['product'])
    ->get()->toTree();
if(!$categories) return;
;?>
@if(!empty($categories))
    <div class="terms_condition_widget filter_sidebar pt0">
        <h4 class="title">{{$widget['title']}}</h4>
        <div class="widget_list">
            <ul class="list_details">
                @foreach($categories as $category)
                    @php($translate = $category->translate(app()->getLocale()))
                    <li><a href="{{$category->getDetailUrl()}}">{{$translate->name}} <span class="float-end">{{$category->product_count}}</span></a></li>
                @endforeach
            </ul>
        </div>
        <hr>
    </div>
@endif
