<div class="g-filter-item mb-3 border-bottom pb-3 border-t divide-gray-200 pt-2 ">
    <div class="item-title relative">
        <h4 class="widget-title fs-22 mb-2 text-base font-[500]">{{__("Customer Rating")}}</h4>
        <svg class="cursor-pointer absolute h-6 w-6 right-0 top-1" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
        </svg>
    </div>

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
