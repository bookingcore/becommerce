<div class="our-shops bgc-f5 mt-5 pt-5">
    <div class="container">
        <div class="fruit_custom_widget mb100">
            <div class="main-title">
                <div class="row pl30 pl0-md pr30 pr0-md">
                    <div class="col-sm-6">
                        <h2 class="mb0">{{ $title }}</h2>
                    </div>
                    @if($load_more_url)
                    <div class="col-sm-6">
                        <a class="title_more_btn thm text-thm float-end mt10 fn-520" href="{{ $load_more_url }}">{{ $load_more_name }}</a>
                    </div>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row mt50">
                <div class="col-xl-4">
                    <div class="banner_one large mb50">
                        <div class="thumb">
                            @if(!empty($bg_image_url))
                                <img src="{{ $bg_image_url }}" alt="{{ $title }}">
                            @endif
                        </div>
                        <div class="details style2">
                            <p class="para">{{ $bg_sub_title }}</p>
                            <h2 class="title">{{ $bg_title }}</h2>
                            @if(!empty($url_apply))
                                <a href="{{ $url_apply }}" class="shop_btn style2">{{ $link_apply }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="col-sm-6 col-lg-4 col-xl-4">
                                    @include('product.search.loop-2')
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
