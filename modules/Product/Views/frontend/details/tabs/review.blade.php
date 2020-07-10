<?php
$review_score= $row->review_data;
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
?>

@include('Layout::admin.message')
<div class="bravo-reviews">
    <div class="review-box">
        <div class="mf-product-rating row">
            @if($score_total > 0)
                <div class="col-md-5 col-sm-12 col-xs-12 col-average-rating">
                    <div class="average-rating">
                        <h6 class="average-label">{{ __('Average Rating') }}</h6>
                        <h3 class="average-value">{{$review_score['score_total']}}</h3>
                        <div class="service-review tour-review-{{$score_total}}">
                            <div class="list-star">
                                <ul class="booking-item-rating-stars">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <div class="booking-item-rating-stars-active"
                                     style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                                    <ul class="booking-item-rating-stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <span class="review">
                    <span class="review_number">{{ $reviewData['total_review'] }}</span>
                    <span class="review_text">{{ $reviewData['total_review'] > 1 ? __('Reviews') : __('Review') }}</span>
                </span>
                        </div>
                        <div class="review-sumary">
                            @if($review_score['rate_score'])
                                @php $star = 5 @endphp
                                @foreach($review_score['rate_score'] as $item)
                                    <div class="item">
                                        <div class="label">
                                            {{__(':num star',['num'=>$star])}}
                                        </div>
                                        <div class="progress">
                                            <div class="percent green" style="width: {{$item['percent']}}%"></div>
                                        </div>
                                        <div class="number">{{$item['percent']}}%</div>
                                    </div>
                                    @php $star-- @endphp
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-{{ $score_total > 0 ? '7' : '12' }} col-sm-12 col-xs-12 col-review_form">
                <div class="review-form form-wrapper">
                    <span class="comment-reply-title">{{ $score_total > 0 ? __('Add a review') : __('Be the first to review "'.$row->title.'"') }}</span>
                    <form action="{{ url(app_get_locale()."/review") }}" method="post" class="comment-form needs-validation" novalidate>
                        @csrf
                        <p class="comment-notes">
                            <span id="email-notes">{{ __('Your email address will not be published.') }}</span>{{__('Required fields are marked')}}
                            <span class="required">*</span>
                        </p>
                        <div class="comment-notes comment-form-rating">
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
                        <div class="form-group">
                            <input type="text" required class="form-control" name="review_title" placeholder="{{__("Title")}}">
                            <div class="invalid-feedback">{{__('Review title is required')}}</div>
                        </div>
                        <div class="form-group">
                            <textarea name="review_content" required class="form-control" placeholder="{{__("Review content")}}" minlength="10"></textarea>
                            <div class="invalid-feedback">
                                {{__('Review content has at least 10 character')}}
                            </div>
                        </div>
                        <p class="form-submit">
                            <input type="hidden" name="review_service_id" value="{{$row->id}}">
                            <input type="hidden" name="review_service_type" value="product">
                            <input id="submit" type="submit" name="submit" class="btn" value="{{__("Submit")}}">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="comments">
        <h2 class="reviews-title">{{ ($review_list) ? __('Reviews') : __(':num Reviews For This Product',['num'=>$review_list->total()]) }}</h2>
        <div class="review-list">
            @if($review_list->total() > 0)
                @foreach($review_list as $item)
                    @php $userInfo = $item->author; @endphp
                    <div class="review-item">
                        <div class="review-item-head">
                            <div class="media">
                                <div class="media-left">
                                    @if($avatar_url = $userInfo->getAvatarUrl())
                                        <img class="avatar" src="{{$avatar_url}}" alt="{{$userInfo->getDisplayName()}}">
                                    @else
                                        <span class="avatar-text">{{ucfirst($userInfo->getDisplayName()[0])}}</span>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$userInfo->getDisplayName()}}</h4>
                                    <div class="date">{{display_datetime($item->created_at)}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="review-item-body">
                            <h4 class="title"> {{$item->title}} </h4>
                            @if($item->rate_number)
                                <ul class="review-star">
                                    @for( $i = 0 ; $i < 5 ; $i++ )
                                        @if($i < $item->rate_number)
                                            <li><i class="fa fa-star"></i></li>
                                        @else
                                            <li><i class="fa fa-star-o"></i></li>
                                        @endif
                                    @endfor
                                </ul>
                            @endif
                            <div class="detail">
                                {{$item->content}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="noreviews">{{__('There are no reviews yet.')}}</p>
            @endif
        </div>
    </div>
</div>


