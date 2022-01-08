<?php
$row = $rows[0];
$translation = $row->translate();
?>
<div class="bc-post">
    <div class="bc-post__thumbnail"><a class="bc-post__overlay" href="{{$row->getDetailUrl()}}"></a>
        {!! get_image_tag($row->image_id,'large') !!}
    </div>
    <div class="bc-post__content">
        <div class="bc-post__top">
            @if($row->cat)
                <?php $cat_tran = $row->cat->translate() ?>
                <div class="bc-post__meta">
                    <a href="{{$row->cat->getDetailUrl()}}">{{$cat_tran->name ?? ''}}</a>
                </div>
            @endif
            <a class="bc-post__title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </div>
        <div class="bc-post__bottom">
            <p>{{display_date($row->created_at)}} {{__('by')}}<a href="#"> {{__($row->author->display_name)}}</a></p>
        </div>
    </div>
</div>
