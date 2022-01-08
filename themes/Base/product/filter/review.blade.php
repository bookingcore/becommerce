<figure>
    <h4 class="widget-title">{{__("By Review")}}</h4>
    @for ($number = 5 ;$number >= 1 ; $number--)
        <div class="bc-checkbox">
            <input class="form-control" type="checkbox" id="review-{{$number}}" name="review">
            <label for="review-{{$number}}">
                <span>
                    @for ($review_score = 1 ;$review_score <= 5 ; $review_score++)
                        <i class="fa fa-star @if($review_score <= $number) rate @endif"></i>
                    @endfor
                </span>
            </label>
        </div>
    @endfor
</figure>
