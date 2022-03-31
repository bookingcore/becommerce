<?php
$review_score= $row->review_data;
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
$review_list = $row->review_list
?>
@include('global.message')
<div class="review-box-top">
    <div class="card-rating mb-2 d-flex mt-1 align-items-center">
        @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
    </div>
    <div class="review-sumary">
        @if($review_score['rate_score'])
            @php $star = 5 @endphp
            @foreach($review_score['rate_score'] as $item)
                <div class="item d-flex align-items-center">
                    @include('global.rating',['percent' =>$star * 100/ 5 ?? 0])
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$item['percent']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$item['percent']}}%"></div>
                    </div>
                    <div class="number">{{$item['percent']}}%</div>
                </div>
                @php $star-- @endphp
            @endforeach
        @endif
    </div>
    <div class="review-button-wrap">
        <a href="#commentform" class="review-link" rel="nofollow">Write A Review</a>
    </div>
</div>
<div class="row">
        <div class="col-md-6">
            <div class="comment-list-wrap fs-14">
                <div class="reviews-title fs-24 mb-3 border-bottom pb-2">{{ ($review_list) ? __('Reviews from guests') : __(':num Reviews For This Product',['num'=>$review_list->total()]) }}</div>
                <div class="review-list">
                    @if($review_list->total())
                        <ol class="comment-list">
                            @if($review_list)
                                @foreach($review_list as $item)
                                    @php $userInfo = $item->author;
                                    if(!$userInfo){ continue; }
                                    @endphp
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="comment-meta">
                                                <div class="comment-author">
                                                    <img src="{{$userInfo->avatar_url}}" class="avatar "  alt="{{$userInfo->display_name}}"/>
                                                    <cite class="fn">{{$userInfo->display_name}}</cite>
                                                </div>
                                                <a href="#" class="comment-date">
                                                    <time datetime="2021-12-23T00:59:15+00:00">{{display_datetime($item->created_at)}}</time> </a>
                                            </div>
                                            <div id="div-comment-136" class="comment-content">
                                                @if($item->rate_number)
                                                    <div class="d-flex mb-2">
                                                        @for( $i = 0 ; $i < 5 ; $i++ )
                                                            @if($i < $item->rate_number)
                                                                <i class="axtronic-icon-star-sharp me-2 c-fcb800"></i>
                                                            @else
                                                                <i class="axtronic-icon-star me-2"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                @endif
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="review-form" id="commentform">
                <span class="fs-18 fw-bold">{{ $score_total > 0 ? __('Submit your review') : __('Be the first to review "'.$row->title.'"') }}</span>
                <form action="{{ url(app_get_locale()."/review") }}" method="post" class="comment-form needs-validation" novalidate>
                    @csrf
                    <p class="mb-0">
                        <span>{{ __('Your email address will not be published.') }}</span>
                    </p>
                    <div class="mb-3">
                        <div class="form-group review-items">
                            <div class="item">
                                <label>{{__("Your rating of this product")}}</label>
                                <input class="review_stats" type="hidden" name="review_rate">
                                <div class="rates">
                                    <i class="fa fa-star-o grey"></i>
                                    <i class="fa fa-star-o grey"></i>
                                    <i class="fa fa-star-o grey"></i>
                                    <i class="fa fa-star-o grey"></i>
                                    <i class="fa fa-star-o grey"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" required class="form-control" name="review_title" placeholder="{{__("Title")}}">
                        <div class="invalid-feedback">{{__('Review title is required')}}</div>
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="review_content" required class="form-control" placeholder="{{__("Review content")}}" minlength="10"></textarea>
                        <div class="invalid-feedback">
                            {{__('Review content has at least 10 character')}}
                        </div>
                    </div>
                    <p class="form-submit">
                        <input type="hidden" name="review_service_id" value="{{$row->id}}">
                        <input type="hidden" name="review_service_type" value="{{$row->type}}">
                        <input id="submit" type="submit" name="submit" class="btn btn-primary" value="{{__("Submit")}}">
                    </p>
                </form>
            </div>
        </div>
    </div>
