<?php
$review_score= $row->review_data;
$reviewData = $row->getScoreReview();
$score_total = $reviewData['score_total'];
$review_list = $row->review_list()
    ->orderByDesc('id')
    ->with('author')
    ->paginate($this->getReviewNumberPerPage());
?>
@include('global.message')
<div class="bc-reviews">
    <div class="row">
        <div class="col-lg-6">
            <div class="shop_single_tab_content mb30-991 pt-0">
                <div class="product_single_content">
                    <div class="mbp_pagination_comments">
                        <h5 class="fz16 mb30">
                            {{ ($review_list) ? __('Reviews from guests') : __(':num Reviews For This Product',['num'=>$review_list->total()]) }}
                        </h5>
                        @if($review_list->total())
                            <div class="bc-review-list">
                                @if($review_list)
                                    @foreach($review_list as $item)
                                        @php $userInfo = $item->author; if(!$userInfo){ continue; }@endphp
                                        <div class="item">
                                            <div class="mbp_first d-flex align-items-center">
                                                <div class="flex-shrink-0 rounded-circle overflow-hidden">
                                                    <img src="{{$userInfo->avatar_url}}" alt="{{$userInfo->display_name}}" class="mr-3">
                                                </div>
                                                <div class="flex-grow-1 ms-4">
                                                    <h4 class="sub_title mt20">{{$userInfo->display_name}}</h4>
                                                    <div class="sspd_postdate mb15">{{display_datetime($item->created_at)}}
                                                        <div class="sspd_review pull-right">
                                                            @if($item->rate_number)
                                                                <ul class="mb0 pl15">
                                                                    @for( $i = 0 ; $i < 5 ; $i++ )
                                                                        @if($i < $item->rate_number)
                                                                            <li class="list-inline-item">
                                                                                <a href="#"><i class="fa fa-star"></i></a>
                                                                            </li>
                                                                        @else
                                                                            <li class="list-inline-item">
                                                                                <a href="#"><i class="fa fa-star text-muted"></i></a>
                                                                            </li>
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-0"> <strong>{{$item->title}}</strong> </p>
                                            <p class="mt0 mb30">{{$item->content}}</p>
                                        </div>
                                        <hr>
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
        </div>
        <div class="col-lg-6">
            <div class="bsp_reveiw_wrt ">
                <div class="review-box">
                    <div class="mf-product-rating ">
                        <div class="review-form comments_form ">
                            <span class="fz16 mb30 text-dark font-weight-bold">{{ $score_total > 0 ? __('Submit your review') : __('Be the first to review "'.$row->title.'"') }}</span>
                            <form action="{{ url(app_get_locale()."/review") }}" method="post" class="comment-form needs-validation" novalidate>
                                @csrf
                                <p class="mb10 mt10">
                                    <span>{{ __('Your email address will not be published. Required fields are marked *') }}</span>
                                </p>
                                <div class="mb20">
                                    <div class="form-group review-items">
                                        <div class="item">
                                            <label>{{__("Your rating of this product")}}</label>
                                            <input class="review_stats" type="hidden" name="review_rate">
                                            <div class="rates mt10">
                                                <i class="fa fa-star grey"></i>
                                                <i class="fa fa-star grey"></i>
                                                <i class="fa fa-star grey"></i>
                                                <i class="fa fa-star grey"></i>
                                                <i class="fa fa-star grey"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fz14 heading-color mb10">{{__("Title")}}</label>
                                    <input type="text" required class="form-control" name="review_title">
                                    <div class="invalid-feedback">{{__('Review title is required')}}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fz14 heading-color mb10">{{__("Your review *")}}</label>
                                    <textarea name="review_content" required class="form-control" minlength="10" rows="6"></textarea>
                                    <div class="invalid-feedback">
                                        {{__('Review content has at least 10 character')}}
                                    </div>
                                </div>
                                <p class="form-submit">
                                    <input type="hidden" name="review_service_id" value="{{$row->id}}">
                                    <input type="hidden" name="review_service_type" value="{{$row->type}}">
                                    <input id="submit" type="submit" name="submit" class="btn btn-thm" value="{{__("Submit")}}">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
