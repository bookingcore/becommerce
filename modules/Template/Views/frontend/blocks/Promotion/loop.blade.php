<div class="mf-banner-medium layout-5 has-img">
    <a class="link-all" href="{{$list['link'] ?? '#'}}"></a>
    <div class="banner-content">
        <div class="s-content">
            <h2 class="title">{!! clean($list['title'] ?? '') !!}</h2>
            @if(empty($list['discount']))
                <div class="desc">
                    {{__('Discount')}}<br>
                    <strong class="price">{{ (!empty($list['sale_price'])) ? format_money($list['sale_price']) : format_money($list['price']) }}</strong>
                    @if(!empty($list['sale_price']))
                        <span class="sale">{{ format_money($list['price']) }}</span>
                    @endif
                </div>
            @else
                <div class="desc">
                    {{__('SALE UP')}}<br>
                    <strong class="price">{{__(':discount% OFF',['discount'=>$list['discount']])}}</strong>
                </div>
            @endif
        </div>
        <div class="link-box">
            <a class="link" href="{{$list['link'] ?? '#'}}">{{__('Shop Now')}}</a>
        </div>
    </div>
    <div class="banner-image">
        {!! get_image_tag($list['image'], 'full') !!}
    </div>
</div>
