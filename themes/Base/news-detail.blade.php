@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="bc-page--blog mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="bc-post--detail sidebar">

                        <div class="px-4 py-5 my-5 text-center">
                            <h1>{{$translation->title}}</h1>
                        </div>
                        <div class="bc-post__content">
                            {!! clean($translation->content) !!}
                        </div>
                        <div class="bc-post__footer">
                            <p class="bc-post__tags">
                                {{__('Tags:')}}
                                @foreach($row->tags as $tag)
                                    <?php $tag_trans = $tag->translate() ?>
                                    <a class="hover-c-main" href="{{$tag->getDetailUrl()}}">{{$tag_trans->name ?? ''}}</a>
                                @endforeach
                            </p>
                            <div class="bc-post__social"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('news.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
