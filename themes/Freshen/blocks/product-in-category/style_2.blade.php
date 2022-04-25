<div class="our-shops bgc-f5 pt30 pb30">
    <div class="container">
        <div class="fruit_custom_widget">
            <div class="row pl30 pl0-md pr30 pr0-md">
                <div class="col-sm-6">
                    <h3 class="ttc">{{ $title }}</h3>
                </div>
                @if($load_more_url)
                <div class="col-sm-6">
                    <a class="title_more_btn thm text-thm float-end fn-520" href="{{ $load_more_url }}">{{ $load_more_name }}</a>
                </div>
                @endif
            </div>
            <hr>
            <div class="row mt30">
                <div class="col-lg-5 col-xl-4">
                    <div class="banner_one large home4_style mb50">
                        <div class="thumb">
                            @if(!empty($bg_image_url))
                                <img src="{{ $bg_image_url }}" alt="{{ $title }}">
                            @endif
                        </div>
                        <div class="details style2">
                            <p class="para {{ $text_class ?? '' }}">{{ $bg_sub_title }}</p>
                            <h3 class="title {{ $text_class ?? '' }}">{{ $bg_title }}</h3>
                            @if(!empty($url_apply))
                                <a href="{{ $url_apply }}" class="shop_btn style2 {{ $text_class ?? '' }}">{{ $link_apply }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop_item_3grid_slider dots_none">
                                @if(!empty($rows))
                                    @foreach($rows as $row)
                                        <div class="item">
                                            @include('product.search.loop-4')
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
