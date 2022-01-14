<div class="mb-3 border-bottom pb-3">
    <h4 class="widget-title fs-22 mb-2">{{__("By Review")}}</h4>
    @for ($number = 5 ;$number >= 1 ; $number--)
        <div class="bc-checkbox">
            <input type="checkbox" id="review-{{$number}}" name="review">
            <label for="review-{{$number}}">
                <span>
                    @for ($review_score = 1 ;$review_score <= 5 ; $review_score++)
                        <i class="ml-1 fa fa-star @if($review_score <= $number) c-main @else c-d2d2d2  @endif"></i>
                    @endfor
                </span>
            </label>
        </div>
    @endfor
</div>
