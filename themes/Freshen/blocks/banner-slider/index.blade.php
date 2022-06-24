@if(!empty($sliders))
    <!-- Home Design -->
    <div class="bc-home-banner main-banner-wrapper">
        <div class="banner-style-one no-dots owl-theme owl-carousel">
            @foreach($sliders as $slide)
                <section class="home-one mt0 bg-home1" style="background-image: url({{ get_file_url($slide['image']?? false,'full') }})">
                    <div class="container">
                        <div class="row posr">
                            <div class="col-lg-8 col-xl-6">
                                <div class="home_content home1_style">
                                    <div class="home-text">
                                        <p class="fz14 fwb ttu text-thm2">{{ $slide['sub_title'] }}</p>
                                        <h2 class="fz60 ttu text-thm2">{!! clean($slide['title']) !!}</h2>
                                        <div class="fz16 text-thm2 dn-sm">{!! clean($slide['sub_text']) !!}</div>
                                        <a class="btn btn-thm2 text-uppercase" href="{{ $slide['link_shop_now'] }}">{{ $slide['btn_shop_now'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
        <div class="carousel-btn-block banner-carousel-btn">
            <span class="carousel-btn left-btn"><i class="flaticon-left-arrow left"></i></span>
            <span class="carousel-btn right-btn"><i class="flaticon-chevron right"></i></span>
        </div><!-- /.carousel-btn-block banner-carousel-btn -->
    </div>
@endif
