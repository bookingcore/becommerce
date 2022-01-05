<figure>
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
    <h4 class="widget-title">{{ __("By Price") }}</h4>
    <div id="nonlinear" data-from="{{$pri_from}}" data-to="{{$pri_to}}"></div>
    <p class="ps-slider__meta">
        {{ __("Price") }}:
        <span class="ps-slider__value">
            {{$currency['symbol']}}<span class="ps-slider__min">{{$price_min}}</span>
        </span>
        -
        <span class="ps-slider__value">
            {{$currency['symbol']}}<span class="ps-slider__max">{{$price_max}}</span>
        </span>
    </p>
    <input type="text" id="ps-min_price" name="min_price" class="d-none" value="{{$price_min}}">
    <input type="text" id="ps-max_price" name="max_price" class="d-none" value="{{$price_max}}">
    <input type="submit" class="btn btn-sm btn-warning mt-2" title="{{__('APPLY')}}" value="{{__('APPLY')}}">
</figure>