<div class="bravo_BannerHome2">
    <div class="container">
        <div class="ps-home-banner">
            <div class="ps-section__left">
                @include('Layout::headers.parts.department')
            </div>
            <div class="ps-section__center">
                <div class="bravo-home-sliders">
                    @if(!empty($sliders))
                        @foreach($sliders as $item)
                            <div class="item">
                                <a href="{!! clean($item['link']) !!}">
                                    {!! get_image_tag($item['image'],'medium',['lazy'=>false]) !!}
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if(!empty($banner_list))
                    @php
                        $banner = $banner_list[0];
                        $price = (!empty($banner['price'] && !empty($banner['sale_price']))) ? $banner['sale_price'] : $banner['price'];
                    @endphp
                    <div class="mf-banner-small">
                        <div class="banner-featured-image" style="background-image: url({!! get_file_url($banner['image'],'medium') !!})"></div>
                        <a class="link" href="{!! clean($banner['link']) !!}"></a>
                        <div class="banner-content {{ $banner['desc_position'] ?? '' }}">
                            <h2 class="banner-title">{!! clean($banner['title']) !!}</h2>
                            <div class="banner-desc">
                                @if(!empty($banner['discount_text']))
                                    <p>{!! clean($banner['discount_text']) !!}<br></p>
                                @endif
                                @if(!empty($banner['price_content']))
                                    <p>{{$banner['price_content']}}<br></p>
                                @endif
                                @if(!empty($banner['price']))
                                    <span class="price">{{ format_money($price) }}</span>
                                    @if(!empty($banner['sale_price']))
                                        <del class="sub_price">{{ format_money($banner['price']) }}</del>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="ps-section__right">
                @if(!empty($banner_list))
                    @php $stt = 0; @endphp
                    @foreach($banner_list as $item)
                        @if($stt > 0)
                            @php
                                $price = (!empty($item['price'] && !empty($item['sale_price']))) ? $item['sale_price'] : $item['price'];
                            @endphp
                            <div class="mf-banner-small">
                                <div class="banner-featured-image" style="background-image: url({!! get_file_url($item['image'],'medium') !!})"></div>
                                <a class="link" href="{!! clean($item['link']) !!}"></a>
                                <div class="banner-content {{ $item['desc_position'] ?? '' }}">
                                    <h2 class="banner-title">{!! clean($item['title']) !!}</h2>
                                    <div class="banner-desc">
                                        @if(!empty($item['discount_text']))
                                            <p>{!! clean($item['discount_text']) !!}<br></p>
                                        @endif
                                        @if(!empty($item['price_content']))
                                            <p>{{$item['price_content']}}<br></p>
                                        @endif
                                        @if(!empty($item['price']))
                                            <span class="price">{{ format_money($price) }}</span>
                                            @if(!empty($item['sale_price']))
                                                <del class="sub_price">{{ format_money($item['price']) }}</del>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php $stt++; @endphp
                    @endforeach
                @endif

                {{--@if(!empty($image_right))
                    @php $stt = 1; @endphp
                    @foreach($image_right as $item)
                        <a @if($stt == 3) class="wide" @endif href="{{$item['link']}}">
                            {!! get_image_tag($item['image'],'full') !!}
                        </a>
                        @php $stt++; @endphp @if($stt > 5) @break @endif
                    @endforeach
                @endif--}}
            </div>
        </div>
    </div>
</div>
