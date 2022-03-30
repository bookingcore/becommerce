@extends('layouts.app')
@section('content')
    <div class="axtronic-page-blog">
        <nav aria-label="breadcrumb" class="axtronic-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/news">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$translation->title}}</li>
                </ol>
            </div>
        </nav>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-9">
                    <div class="axtronic-post">
                        <div class="axtronic-post-detail entry-content">
                            <div class="post-header">
                                <div class="meta-categories">
                                    <a href="#" rel="category tag">Tips &amp; Tricks</a>
                                    <a href="" rel="category tag">Uncategorized</a>
                                </div>
                                <h2 class="post-title">{{$translation->title}}</h2>
                                <div class="entry-meta">
                                    <div class="post-author">
                                        <span class="label">{{ __('By') }} </span>
                                        <a href="#" rel="author">
                                            <span class="vcard author author_name">{{$row->author->last_name}} </span>
                                        </a>
                                    </div>
                                    <span class="meta-comment">
                                        <a class="comment-link" href="#comments">Comments: 3</a>
                                    </span>
                                    <div class="posted-on">
                                        <a href="#">{{display_date($row->created_at)}}</a>
                                    </div>
                                </div>
                            </div>
                            <a class="ratio ratio-16x9 d-block post-review mb-5" href="{{$row->getDetailUrl()}}">
                                {!! get_image_tag($row->image_id,'large',['class'=>'object-cover']) !!}
                            </a>
                            <div class="axtronic-post_content">
                                {!! clean($translation->content) !!}
                            </div>
                            <div class="axtronic-post_footer">
                                {{--@if($row->tags->count())--}}
                                <div class="axtronic-post_tags">
                                    <i class="axtronic-icon-tag"></i>
                                    <a class="tag" href="#" rel="tag">Home</a>
                                    <a class="tag" href="#">Renovated</a>
                                    @foreach($row->tags as $tag)
                                        <?php $tag_trans = $tag->translate() ?>
                                        <a class="tag" href="{{$tag->getDetailUrl()}}">{{$tag_trans->name ?? ''}}</a>
                                    @endforeach
                                </div>
                                {{--@endif--}}
                            </div>
                        </div>

                    </div>
                    @include('news.comment')
                    @if($related_post)
                        @include('news.related-post')
                    @endif
                </div>
                <div class="col-md-3">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
