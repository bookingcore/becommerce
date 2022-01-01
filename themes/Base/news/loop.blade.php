<?php
$row = $rows[0];
$translation = $row->translate();
?>
<div class="ps-post">
    <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="{{$row->getDetailUrl()}}"></a>
        {!! get_image_tag($row->image_id,'large') !!}
    </div>
    <div class="ps-post__content">
        <div class="ps-post__top">
            @if($row->cat)
                <?php $cat_tran = $row->cat->translate() ?>
                <div class="ps-post__meta">
                    <a href="{{$row->cat->getDetailUrl()}}">{{$cat_tran->name ?? ''}}</a>
                </div>
            @endif
            <a class="ps-post__title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </div>
        <div class="ps-post__bottom">
            <p>{{display_date($row->created_at)}} {{__('by')}}<a href="#"> {{__($row->author->display_name)}}</a></p>
        </div>
    </div>
</div>
