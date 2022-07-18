<div class="mb-3 border-bottom pb-3 border-t divide-gray-200 pt-2">
    <h4 class="widget-title fs-22 mb-2 text-base font-[500]">{{__("Customer Rating")}}</h4>
    @for ($number = 5 ;$number >= 1 ; $number--)
        <div class="bc-checkbox">
            <input name="review_score[]" id="review-{{$number}}" type="checkbox" value="{{$number}}" @if(  in_array($number , request()->query('review_score',[])) )  checked @endif>
            <label for="review-{{$number}}">
                <span>
                    @for ($review_score = 1 ;$review_score <= 5 ; $review_score++)
                        <i class="ml-1  @if($review_score <= $number) bc-icon-star @else bc-icon-star-o  @endif"></i>
                    @endfor
                </span>
            </label>
        </div>
    @endfor
</div>
