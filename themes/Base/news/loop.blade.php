<?php
$row = $rows[0];
$translation = $row->translate();
?>
<div class="bc-post card">
    <a class="ratio ratio-16x9 d-block" href="{{$row->getDetailUrl()}}">
        {!! get_image_tag($row->image_id,'large',['class'=>'object-cover']) !!}
    </a>
    <div class="card-body">
        @if($row->cat)
            <?php $cat_tran = $row->cat->translate() ?>
            <div class="bc-post__meta mb-2">
                <a href="{{$row->cat->getDetailUrl()}}" class="badge bg-warning">{{$cat_tran->name ?? ''}}</a>
            </div>
        @endif
        <h5 class="card-title">
            <a class="bc-post__title" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        </h5>
        <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($translation->content), 12, '....') !!}</p>
            <p class="card-text"><small class="text-muted">{{display_date($row->created_at)}}</small></p>
    </div>
</div>
