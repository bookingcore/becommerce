@foreach($attributes as $attribute)
    <figure>
        <h4 class="widget-title">{{$attribute->name}}</h4>
        <ul class="list-unstyled">
            @for ($number = 5 ;$number >= 1 ; $number--)
                <li>
                    <div class="bravo-checkbox">
                        <label>
                            <input name="review_score[]" type="checkbox" value="{{$number}}" @if(  in_array($number , request()->query('review_score',[])) )  checked @endif>
                            <span class="checkmark"></span>
                            @for ($review_score = 1 ;$review_score <= $number ; $review_score++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </label>
                    </div>
                </li>
            @endfor
        </ul>
    </figure>

@endforeach
