@extends('layouts.app')
@section('content')
    <div class="bc-page-blog py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="bc-post-detail">
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
                        <div class="bc-post_content">
                            {!! clean($translation->content) !!}
                        </div>
                        <div class="bc-post_footer">
                            @if($row->tags->count())
                                <div class="bc-post_tags mt-5">
                                    <h6>{{__('Tags:')}}</h6>
                                    @foreach($row->tags as $tag)
                                        <?php $tag_trans = $tag->translate() ?>
                                        <a class="tag" href="{{$tag->getDetailUrl()}}">{{$tag_trans->name ?? ''}}</a>
                                    @endforeach
                                </div>
                            @endif


                        </div>
                    </div>
                    @if($row->getReviewEnable())
                        <div class="mt-4 pt-4 border-top">
                            @includeIf('product.details.tabs.review')

                        </div>
                    @endif()
                    @if($related_post->count()>0)
                        <div class="related-post mt-4 border-top">
                            <h5 class="post-title text-center mt-5">{{ __('You Might Also Like') }}</h5>
                            <div class="post-content">
                                <div class="row">
                                    @foreach($related_post as $post)
                                        @php $translation = $post->translate(); @endphp
                                        <div class="col-lg-4">
                                            <div class="post-review">
                                                <a href="{{ $post->getDetailUrl() }}">
                                                    <img class="img-cover" src="{{ get_file_url($post->image_id) }}" alt="{{ $translation->title }}">
                                                </a>
                                            </div>
                                            <div class="post-body">
                                                <h6 class="post-title">{{ $translation->title }}</h6>
                                                <p class="m-0 post-date opacity-75">{{ display_date($post->created_at) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif



                </div>
                <div class="col-md-4">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
