@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="ps-page--blog mt-5">
        <div class="container">
            <div class="ps-blog--sidebar">
                <div class="ps-blog__left">
                    <div class="ps-post--detail sidebar">
                        <div class="ps-post__header">
                            <h1>{{$translation->title}}</h1>
                            <p>{{display_date($row->created_at)}} / {{__('By')}} {{$row->author->display_name ?? ''}}
                                @if($cat = $row->category)
                                    /
                                    <?php $cat_trans = $cat->translate() ?>
                                    <a href="{{$cat->getDetailUrl()}}">{{$cat_trans->name ?? ''}}</a>
                                @endif
                            </p>
                        </div>
                        <div class="ps-post__content">
                            {!! clean($translation->content) !!}
                        </div>
                        <div class="ps-post__footer">
                            <p class="ps-post__tags">
                                {{__('Tags:')}}
                                @foreach($row->tags as $tag)
                                    <?php $tag_trans = $tag->translate() ?>
                                    <a class="hover-c-main" href="{{$tag->getDetailUrl()}}">{{$tag_trans->name ?? ''}}</a>
                                @endforeach
                            </p>
                            <div class="ps-post__social"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="ps-blog__right">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
