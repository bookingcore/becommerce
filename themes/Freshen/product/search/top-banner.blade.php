@if(!empty($top_banner))
    <div class="main-banner-wrapper shop_item_list5">
        <div class="banner-style-one no-dots owl-theme owl-carousel">
            @foreach($top_banner as $banner)
                @php($img = get_file_url($banner['img_id']))
                <div class="slide slide-one" style="background-image: url({{$img}});height: 400px;">
                    <div class="container">
                        <div class="row home-content">
                            <div class="col-lg-12 p0"><p class="fwb ttu text-thm2">{{$banner['sub_title']}} </p>
                                <h3 class="banner-title text-thm2 ttu">
                                    <span class="fwb">{{$banner['title']}}</span></h3>
                                <p class="text-thm2">
                                    <span class="fwb">{{$banner['description']}}</p>
                                @if(!empty($banner['button_url']))
                                    <a href="{{$banner['button_url']}}" class="btn p0">
                                        <button class="banner-btn btn-thm">{{$banner['button_text']}}</button>
                                    </a>
                                @else
                                    <button class="banner-btn btn-thm">{{$banner['button_text']}}</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
