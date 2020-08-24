<div class="mf-banner-medium layout-5 has-img">
    <a class="link-all" href="{{$list['link'] ?? '#'}}"></a>
    <div class="banner-content">
        <div class="s-content">
            <h2 class="title">{!! clean($list['title'] ?? '') !!}</h2>
            @if(!empty($list['discount']))
                @if($style == 0)
                    <div class="desc">
                        {{__('SALE UP')}}<br>
                        <strong class="price">{{__(':discount% OFF',['discount'=>$list['discount']])}}</strong>
                    </div>
                @else
                    <div class="banner-price @if($list['discount_position'] == 'bottom') bottom @endif">
                        <span class="s-price">{{__(':discount% OFF',['discount'=>$list['discount']])}}</span>
                    </div>
                @endif
            @else
                @if(!empty($list['price']))
                    <div class="desc">
                        {{__('Discount')}}<br>
                        @php
                            $price = 0;
                            if (!empty($list['sale_price']) && !empty($list['price'])){
                                $price = $list['sale_price'];
                            } else {
                                $price = $list['price'];
                            }
                        @endphp
                        <strong class="price">{{ format_money($price) }}</strong>
                        @if(!empty($list['sale_price']))
                            <span class="sale">{{ format_money($list['price']) }}</span>
                        @endif
                    </div>
                @endif
            @endif
            @if(!empty($list['desc']))
                <div class="desc-content">
                    {!! clean($list['desc']) !!}
                </div>
            @endif
        </div>
        @if($style == 0)
            <div class="link-box">
                <a class="link" href="{{$list['link'] ?? '#'}}">Shop Now</a>
            </div>
        @endif
    </div>
    <div class="banner-image">
        {!! get_image_tag($list['image'], 'full') !!}
    </div>
</div>
