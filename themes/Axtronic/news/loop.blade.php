<?php
$translation = $row->translate();
?>
<div class="axtronic-post post">
    <div class="post-thumbnail">
        <a href="{{$row->getDetailUrl()}}" class="ratio ratio-16x9 d-block">
            {!! get_image_tag($row->image_id,'large',['class'=>'object-cover']) !!}
        </a>
    </div>
    <div class="entry-content">
        <div class="entry-meta">
            <div class="post-author">
                <span class="label">{{ __('By') }} </span>
                <a href="#" rel="author">
                    <span class="vcard author author_name">{{$row->author->last_name}} </span>
                </a>
            </div>
            @if($row->tags->count())
                <div class="meta-categories">
                    @php $tags = []; @endphp
                    @foreach($row->tags as $tag)
                        <a class="category tag" href="{{ route('news.tag',['slug' => $tag->slug]) }}">{{ $tag->name }}</a>@if(!$loop->last),@endif
                    @endforeach
                </div>
            @endif
            <div class="posted-on">
                <a href="#">{{display_date($row->created_at)}}</a>
            </div>
        </div>
        <h2 class="entry-title">
            <a href="{{$row->getDetailUrl()}}" >{{$translation->title}}</a>
        </h2>
        <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($translation->content), 50, ' ...') !!}</p>
        <div class="axtronic-read-more">
            <a href="{{ $row->getDetailUrl() }}" class="button button-hover">
                {{ __('Read More') }}
                <i class="axtronic-icon-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
