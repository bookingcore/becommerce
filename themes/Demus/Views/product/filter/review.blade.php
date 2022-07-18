
    <h3 class="widget_title">{{__("By Review")}}</h3>
    @for ($number = 5 ;$number >= 1 ; $number--)
        <div class="demus-checkbox">
            <input name="review_score[]" id="review-{{$number}}" type="checkbox" value="{{$number}}" @if(  in_array($number , request()->query('review_score',[])) )  checked @endif>
            <label for="review-{{$number}}">
                @for ($review_score = 1 ;$review_score <= 5 ; $review_score++)
                    <i class="ml-1 axtronic-icon-star-sharp @if($review_score <= $number) c-main @else c-d2d2d2  @endif"></i>
                @endfor
            </label>
        </div>
    @endfor

