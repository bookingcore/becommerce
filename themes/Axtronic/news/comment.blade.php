<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/21/2022
 * Time: 8:59 PM
 */

$review_score= $row->review_data;
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
$review_list = $row->review_list
?>
@include('global.message')
<section id="comments" class="comments-area">
    <div class="clearfix">
        <div class="comment-list-wrap">
            <h3 class="title-comment">
                {{ $score_total }} Responses
            </h3>
            @if($review_list->total())
                <ol class="comment-list">
                    @if($review_list)
                        @foreach($review_list as $item)
                            @php $userInfo = $item->author;
                                    if(!$userInfo){ continue; }
                            @endphp
                            <li class="comment ">
                                <div class="comment-body">
                                    <div class="comment-meta">
                                        <div class="comment-author">
                                            <img src="{{$userInfo->avatar_url}}" class="avatar "  alt="{{$userInfo->display_name}}"/>
                                            <cite class="fn">{{$userInfo->display_name}}</cite>
                                        </div>
                                        <a href="#" class="comment-date"><time >{{display_datetime($item->created_at)}}</time> </a>
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-text">
                                            <h4>{{$item->title}}</h4>
                                            <p> {{$item->content}}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ol>
            @endif
        </div>
        <div id="respond" class="comment-respond">
            <h2 id="reply-title" class="comment-reply-title">
                {{ $score_total > 0 ? __('Leave a Reply') : __('Be the first to review "'.$row->title.'"') }}
            </h2>
            <p><span>{{ __('Your email address will not be published. Required fields are marked ') }} <span class="required">*</span></span></p>
            <form action="{{ url(app_get_locale()."/review") }}" method="post" class="comment-form needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> {{ __('Name') }} <span class="required">*</span></label>
                            <input type="text" required class="form-control" name="review_title" placeholder="{{__("Title")}}">
                        </div>
                    </div>
                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="">{{ __('Email') }}  <span class="required">*</span></label>--}}
                            {{--<input type="text" value="" placeholder="" name="email" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="">{{ __('Website') }}  <span class="required">*</span></label>--}}
                            {{--<input type="text" value="" placeholder="" name="website" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-md-12 my-3">
                        <div class="form-group">
                            <label for="">{{ __('Comment ') }}</label>
                            <textarea name="review_content" required class="form-control" placeholder="{{__("Review content")}}" minlength="10" rows="8"></textarea>
                            <div class="invalid-feedback">
                                {{__('Review content has at least 10 character')}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <input type="hidden" name="review_service_id" value="{{$row->id}}">
                        <input type="hidden" name="review_service_type" value="{{$row->type}}">
                        <input id="submit" type="submit" name="submit" class="btn btn-primary" value="{{__("Post Comment")}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
