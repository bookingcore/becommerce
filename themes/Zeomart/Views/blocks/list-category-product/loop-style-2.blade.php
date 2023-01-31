<?php
$translation = $row->translate();
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>
<div class="bc-loop-product flex items-center py-4">
    <div class="image flex-[100px] flex-shrink-0 px-2">
        <a href="{{$row->getDetailUrl()}}" class="mi-h-230">
            {!! get_image_tag($row->image_id,'medium',['alt'=>$translation->title,'class'=>'']) !!}
        </a>
    </div>
    <div class="ml-2">
        <a class="text-sm font-[500] mb-1 mr-1 block" href="{{$row->getDetailUrl()}}">{{$translation->title}}</a>
        <div class="children:p-4">
            @include('product.details.price')
        </div>
    </div>
</div>
