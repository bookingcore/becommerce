<div class="bc-slider-price">
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
    <h3 class="widget_title">{{ __("By Price") }}</h3>
    <div class="p-2">
        <div id="nonlinear" class="nonlinear" data-from="{{$pri_from}}" data-to="{{$pri_to}}" data-min="{{$price_min}}" data-max="{{$price_max}}"></div>
    </div>
    <div class="slider-meta">
        {{ __("Price") }}:
        <span class="slider-value">
            {{$currency['symbol']}}<span class="slider-min">{{$price_min}}</span>
        </span>
        -
        <span class="slider-value">
            {{$currency['symbol']}}<span class="slider-max">{{$price_max}}</span>
        </span>
    </div>
    <input type="text" name="min_price" class="d-none" value="{{$price_min}}">
    <input type="text" name="max_price" class="d-none" value="{{$price_max}}">
    <input type="submit" class="btn " title="{{__('APPLY')}}" value="{{__('APPLY')}}">
</div>
