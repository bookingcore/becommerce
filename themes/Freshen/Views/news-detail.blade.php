@extends('layouts.app')
@section('content')
    <section class="inner_page_breadcrumb" @if($image = setting_item('news_page_image')) style="background-image: url('{{get_file_url($image,'max')}}')" @endif>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb_content">
                        <h2 class="breadcrumb_title">{{$translation->title}}</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('news')}}">{{__('News')}}</a></li>
                            @if($row->cat)
                                <?php
                                $cat_tran = $row->cat->translate();
                                ?>
                                <li class="breadcrumb-item"><a href="{{$row->cat->getDetailUrl()}}">{{$cat_tran->name}}</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$translation->title}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog_post_container pb80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    <div class="main_blog_post_content">
                        @include('news.loop',['for_single'=>1])
                        <div class="mbp_thumb_post fz14 ">
                            {!! clean($translation->content) !!}
                        </div>
                        <div class="mt50">
                            <div class="bsp_tags float-start fn-lg mt10 mb30-lg">
                                @if($row->tags->count())
                                    <ul class="mb0">
                                        <li class="list-inline-item">{{__('Tags:')}}</li>
                                        @foreach($row->tags as $tag)
                                            <?php $tag_trans = $tag->translate() ?>
                                            <li class="list-inline-item"><a href="{{$tag->getDetailUrl()}}">{{$tag_trans->name ?? ''}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <ul class="blog_post_share text-end tal-lg mb0">
                                <li class="list-inline-item">{{__('Share this post:')}}</li>
                                <li class="list-inline-item"><a href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$translation->title}}"><span class="fa fa-facebook"></span></a></li>
                                <li class="list-inline-item"><a href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}"><span class="fa fa-twitter"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="mt50">
                    @include('news.related')
                </div>
                <div class="col-lg-4 col-xl-3">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
