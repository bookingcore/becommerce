@php
    use Modules\Product\Models\Product;
    $product_min_max_price  = Product::getMinMaxPrice();
    $min_price = $pri_from = floor ( ($product_min_max_price[0]) );
    $max_price = $pri_to = ceil ( ($product_min_max_price[1]) );
    if (!empty($min = Request::query('min_price'))) {
        $pri_from = $min;
    }
    if (!empty($max = Request::query('max_price'))) {
        $pri_to = $max;
    }
    $currency = App\Currency::getCurrency(setting_item('currency_main'));
@endphp
<div class="sidebar_priceing_slider_mobile mb20">
    <div class="wrapper">
        <h4 class="title">{{__('Filter by price')}}</h4>
        <div class="slider-range"></div>
        <input type="hidden" name="min_price" value="{{$pri_from}}">
        <input type="hidden" name="max_price" value="{{$pri_to}}">
        <input type="text" readonly class="amount" min="{{$min_price??0}}"  placeholder="{{format_money($pri_from)}}">
        <input type="text" readonly class="amount2" max="{{$max_price??0}}"  placeholder="{{format_money($pri_to)}}">
    </div>
    <input type="submit" class="btn btn-sm btn-thm mt-2" title="{{__('APPLY')}}" value="{{__('APPLY')}}">
    <hr class="mt30">
</div>
