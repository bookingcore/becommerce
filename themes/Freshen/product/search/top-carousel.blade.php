@if(!empty($carouselTopSearchPage))
    <div class="main-banner-wrapper shop_item_list5">
        <div class="banner-style-one no-dots owl-theme owl-carousel">
            @foreach($carouselTopSearchPage as $item)
                @php($img = get_file_url($item['image_id']))
                <div class="slide slide-one" style="background-image: url({{$img}});height: 400px;">
                    <div class="container">
                        <div class="row home-content">
                            <div class="col-lg-12 p0"><p class="fwb ttu text-thm2">{!! clean($item['sub_title']) !!} </p>
                                <h3 class="banner-title text-thm2 ttu">
                                    <span class="fwb">{!! clean($item['title']) !!}</span></h3>
                                <p class="text-thm2">
                                    <span class="fwb">{!! clean($item['desc']) !!}</p>
                                @if(!empty($item['button_link']))
                                    <a href="{{$item['button_link']}}" class="btn p0">
                                        <button class="banner-btn btn-thm">{{$item['button_text']}}</button>
                                    </a>
                                @else
                                    <button class="banner-btn btn-thm">{{$item['button_text']}}</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
