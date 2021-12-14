@if(!\Illuminate\Support\Facades\Auth::id())
    <div class="col-product-sidebar-item product-sidebar-custom-html">
        <i style="font-size: 18px" class="icon-store"></i>
        <span style="color: #000; padding-left: 10px">{{ __('Sell on Becommerce?') }} </span>
        <a href="{{route('route.page',['slug'=>'become-a-vendor'])}}">{{__('Register Now!')}}</a>
    </div>
@endif
<div class="col-product-sidebar-item product-sidebar-custom-link">
    <a href="{{setting_item('ads_url')}}">
        {!! get_image_tag(setting_item('ads_image'),'medium',['lazy'=>false]) !!}
    </a>
</div>
