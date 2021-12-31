<figure>
    <h4 class="widget-title">{{__("By Price")}}</h4>
    <div class="bravo-filter-price">
        <?php
        $price_min = $pri_from = floor ( ($product_min_max_price[0]) );
        $price_max = $pri_to = ceil ( ($product_min_max_price[1]) );
        if (!empty($min_price = Request::query('min_price'))) {
            $pri_from = $min_price;
        }
        if (!empty($max_price = Request::query('max_price'))) {
            $pri_to = $max_price;
        }
        $currency = App\Currency::getCurrency(setting_item('currency_main'));?>
        <div class="price_slider"  data-from="{{$pri_from}}" data-to="{{$pri_to}}"></div>
        <div class="bravo-filter-price-amount" data-step="10">
            <input type="text" id="min_price" name="min_price" class="d-none" value="{{$price_min}}"
                   data-min="{{$price_min}}">
            <input type="text" id="max_price" name="max_price" class="d-none" value="{{$price_max}}"
                   data-max="{{$price_max}}">
            <button type="submit" class="button d-sm-block d-md-none">{{__('Filter')}}</button>
            <div class="price_label">
                {{__('Price')}}: {{$currency['symbol']}}<span class="from">{{($price_min)}}</span> — {{$currency['symbol']}}<span
                    class="to">{{($price_max)}}</span>
            </div>
            <div class="clear"></div>
        </div>
        <input type="submit" class="bravo-price-submit" title="{{__('APPLY')}}" value="{{__('APPLY')}}">
    </div>
</figure>
