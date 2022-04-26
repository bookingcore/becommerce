@php
    use Modules\Product\Models\Product;
    $product_min_max_price  = Product::getMinMaxPrice();
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
<div class="sidebar_priceing_slider_mobile mb20">
    <div class="wrapper">
        <h4 class="title">{{__('Filter by price')}}</h4>
        <div class="slider-range"></div>
        <input type="text" class="amount" placeholder="{{format_money($price_min)}}">
        <input type="text" class="amount2" placeholder="{{format_money($price_max)}}">
    </div>
    <hr class="mt30">
</div>
