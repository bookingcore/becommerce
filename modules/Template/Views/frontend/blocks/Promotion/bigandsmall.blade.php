<div class="mf-banner-large  layout-2 " style="background-color:#f8f8f8;">
    <div class="featured-image" style="background-image:url({{get_file_url($list['image'],'full')}})"></div>
    <a class="link-all" href="{{$list['link'] ?? ''}}"></a>
    <div class="row banner-row">
        <div class="col-md-offset-1 col-md-4 col-sm-6 col-xs-12 col-banner-content">
            <div class="banner-content">
                <h2 class="box-title">
                    {{$list['title']}}<br>
                    {{__('DISCOUNT')}} <strong class="r-price">{{__(':discount% OFF',['discount'=>$list['discount']])}}</strong>
                </h2>
                <p class="desc">{!! __($list['desc']) !!}</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 col-banner-price">
            <div class="banner-price">
                <span class="sale-price">{{ format_money(!empty($list['sale_price']) ? $list['price'] : $list['sale_price']) }}</span>
                <span class="s-price">{{ format_money(!empty($list['sale_price']) ? $list['sale_price'] : $list['price']) }}</span>
                <a class="link" href="{{$list['link'] ?? ''}}">{{__('Shop Now')}}</a>
            </div>
        </div>
    </div>
</div>
