<?php
$translation = $row->translate();
?>
<div class="bc-post post">
    <div class="post-header mb-4">
        <h2 class="post-title"><a href="{{$row->getDetailUrl()}}" class="c-333333">{{$translation->title}}</a></h2>
        <ul class="post-meta list-unstyled d-flex m-0">
            <li><i class="fa fa-calendar"></i> {{display_date($row->created_at)}}</li>
            @if($row->tags->count())
                <li>
                    <i class="fa fa-tags"></i>
                    @php $tags = []; @endphp
                    @foreach($row->tags as $tag)
                        <a class="c-333333" href="{{ route('news.tag',['slug' => $tag->slug]) }}">{{ $tag->name }}</a>@if(!$loop->last),@endif
                    @endforeach
                </li>
            @endif
        </ul>
    </div>
    <a class="ratio ratio-16x9 d-block post-review mb-4" href="{{$row->getDetailUrl()}}">
        {!! get_image_tag($row->image_id,'large',['class'=>'object-cover']) !!}
    </a>
    <div class="post-description mb-4">
        <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($translation->content), 50, '....') !!}</p>
    </div>
    <div class="bc-read-more">
        <a href="{{ $row->getDetailUrl() }}" class="btn btn-read-more">
            {{ __('Read More') }} <i class="fa fa-arrow-right"></i>
        </a>
    </div>
</div>
