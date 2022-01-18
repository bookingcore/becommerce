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


                    <div class="average-rating ">
                        <h6>{{ __('Average Rating') }}</h6>
                        <h3>{{$review_score['score_total']}}</h3>

                        <div class="card-rating mb-2 d-flex mt-1 align-items-center">
                            @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                        </div>
                        <span>{{ $review_score['total_review'] }}</span>
                        <span>{{ $review_score['total_review'] > 1 ? __('Reviews') : __('Review') }}</span>

                        <div class="review-sumary">
                            @if($review_score['rate_score'])
                                @php $star = 5 @endphp
                                @foreach($review_score['rate_score'] as $item)
                                    <div class="item d-flex">
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
            <div class="col-md-{{ $score_total > 0 ? '7' : '12' }} col-sm-12 col-xs-12">
                <div class="review-form">
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
                            <input type="hidden" name="review_service_type" value="product">
                            <input id="submit" type="submit" name="submit" class="btn btn-primary" value="{{__("Submit")}}">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="comments">
        <h2 class="reviews-title">{{ ($review_list) ? __('Reviews') : __(':num Reviews For This Product',['num'=>$review_list->total()]) }}</h2>
        <div class="review-list">
                @if($review_list->total())
                    <div class="bc-review-list">
                        @if($review_list)
                            @foreach($review_list as $item)
                                @php $userInfo = $item->author; if(!$userInfo){ continue; }@endphp
                                <div class="review-item pt-2 pb-2 ">
                                    <div class="d-flex align-items-start">
                                        <img class="flex-shrink-0 me-3 rounded-circle w-75px h-75px" src="{{$userInfo->avatar_url}}" alt="{{$userInfo->display_name}}">
                                        <div>
                                            <p class="mb-0 fs-18">{{$userInfo->getDisplayName()}} - {{display_datetime($item->created_at)}}</p>
                                            @if($item->rate_number)
                                                <div class="d-flex mb-2">
                                                    @for( $i = 0 ; $i < 5 ; $i++ )
                                                        @if($i < $item->rate_number)
                                                            <i class="fa fa-star me-2 c-fcb800"></i>
                                                        @else
                                                            <i class="fa fa-star-o me-2"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            @endif
                                            <h5 class="mb-0"> {{$item->title}} </h5>
                                            <p>
                                                {{$item->content}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="bravo-pagination">
                        {{$review_list->appends(request()->query())->links()}}
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">{{__("There are no reviews yet.")}}</div>
                @endif

        </div>
    </div>
</div>


