<div class="bc-slider-price widget">
    @php
    $price_min = $pri_from = floor ( ($product_min_max_price[0]) );
    $price_max = $pri_to = ceil ( ($product_min_max_price[1]) );
    if (!empty($min_price = Request::query('min_price'))) {
        $pri_from = $min_price;
    }
    if (!empty($max_price = Request::query('max_price'))) {
        $pri_to = $max_price;
    }
    $currency = App\Currency::getCurrency(setting_item('currency_main'));
    @endphp
    <h6 class="widget_title">{{__($widget['title'])}}</h6>
    <div class="p-2">
        <div id="nonlinear" class="nonlinear" data-from="{{$pri_from}}" data-to="{{$pri_to}}" data-min="{{$price_min}}" data-max="{{$price_max}}"></div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <div class="slider-meta">
            {{ __("Price") }}:
            <span class="slider-value">
            {{$currency['symbol']}}<span class="slider-min">{{$price_min}}</span>
        </span>
                             -
            <span class="slider-value">
            {{$currency['symbol']}}<span class="slider-max">{{$price_max}}</span>
        </span>
            <input type="text" name="min_price" class="d-none" value="{{$price_min}}">
            <input type="text" name="max_price" class="d-none" value="{{$price_max}}">
        </div>

        <button type="submit" class="btn btn-small" title="{{__('APPLY')}}" ><span>{{__('Filter')}}</span></button>
    </div>

</div>
