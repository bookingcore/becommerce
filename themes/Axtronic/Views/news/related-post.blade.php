<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/21/2022
 * Time: 4:32 PM
 */
?>
<div class="related-post">
    <h5 class="post-title text-center mt-5">{{ __('You Might Also Like') }}</h5>
    <div class="post-content">
        <div class="row">
            @foreach($related_post as $post)
                @php $translation = $post->translate(); @endphp
                <div class="col-lg-4">
                    <div class="axtronic-post post">
                        <div class="post-thumbnail">
                            <div class="posted-on-square"><b>{{$post->created_at->format('d')}}</b> {{month_translation($post->created_at->format('m') - 1)}}</div>
                            <a href="{{$post->getDetailUrl()}}" class="d-block ratio ratio-16x9">
                                {!! get_image_tag($post->image_id,'medium',['class'=>'object-cover img-whp lazy loaded','alt'=>$translation->title]) !!}
                            </a>
                        </div>
                        <div class="entry-content">
                            <div class="entry-meta">
                                <div class="post-author">
                                    <span class="label">{{ __('By') }} </span>
                                    <a href="#" rel="author">
                                        <span class="vcard author author_name">{{$post->author->last_name}} </span>
                                    </a>
                                </div>
                                @if($post->tags->count())
                                    <div class="meta-categories">
                                        @php $tags = []; @endphp
                                        @foreach($post->tags as $tag)
                                            <a class="category tag" href="{{ route('news.tag',['slug' => $tag->slug]) }}">{{ $tag->name }}</a>@if(!$loop->last),@endif
                                        @endforeach
                                    </div>
                                @endif
                                @if($post->cat)
                                    <?php
                                    $cat_tran = $post->cat->translate();
                                    ?>
                                    <div class="meta-categories">
                                        <a class="category tag" href="{{$post->cat->getDetailUrl()}}">{{$cat_tran->name}}</a>
                                    </div>
                                @endif
                                <div class="posted-on">
                                    <a href="#"> {{display_date($post->created_at)}}</a>
                                </div>
                            </div>
                            <h2 class="entry-title">
                                <a href="{{$post->getDetailUrl()}}" >{{$translation->title}}</a>
                            </h2>
                            <p class="card-text">{!! \Illuminate\Support\Str::words(strip_tags($translation->content), 50, ' ...') !!}</p>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
