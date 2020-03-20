<div class="bravo_BannerHome1">
    <div class="martfury-container">
        <div class="row">
            <div class="col-sm-12 col-lg-9 col-xs-12">
                <div class="bravo-home-sliders">
                    @if(!empty($sliders))
                        @foreach($sliders as $item)
                            <div class="slotholder">
                                {!! get_image_tag($item['image'], 'full') !!}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 col-md-12 col-xs-12 hidden-xs">
                @if(!empty($saleOff))
                    @foreach($saleOff as $item)
                        <div class="mf-banner-small has-img">
                            <div class="b-image">{!! get_image_tag($item['image'], 'full') ?? '' !!}</div>
                            <a class="link" href="{{$item['link'] ?? '#'}}"></a>
                            <div class="box-price">
                                <span class="s-price">{{$item['number'] ?? ''}}<br> OFF</span>
                            </div>
                            <div class="banner-content">
                                <h2 class="box-title">
                                    {!! $item['title'] ?? '' !!}
                                </h2>
                                <p class="desc">
                                    {!! $item['sub_title'] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
