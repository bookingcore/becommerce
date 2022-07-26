<?php
$translation = $row->translate();
?>
<div class="axtronic-post post">
    <div class="post-thumbnail mb-3 mb-lg-4 pb-1">
        <a href="{{$row->getDetailUrl()}}" class="d-block">
            {!! get_image_tag($row->image_id,'large',['class'=>'object-cover img-whp ','alt'=>$translation->title]) !!}
        </a>
    </div>
    <div class="entry-content">
        <div class="entry-meta d-flex flex-wrap align-items-center mb-2 text-uppercase">
            @if($row->cat)
                <?php
                $cat_tran = $row->cat->translate();
                ?>
                <div class="meta-categories">
                    <a class="category tag" href="{{$row->cat->getDetailUrl()}}">{{$cat_tran->name}}</a>
                </div>
            @endif
                <div class="posted-on">{{month_translation($row->created_at->format('m') - 1)}} {{$row->created_at->format('d')}}, {{$row->created_at->format('Y')}} </div>

        </div>
        <h5 class="entry-title">
            <a href="{{$row->getDetailUrl()}}" >{{$translation->title}}</a>
        </h5>
        <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($translation->content), 15, ' ...') !!}</p>
        <div class="axtronic-read-more">
            <a href="{{ $row->getDetailUrl() }}" class="btn-link-outline ">
                {{ __('Read More') }}
            </a>
        </div>
    </div>
</div>
