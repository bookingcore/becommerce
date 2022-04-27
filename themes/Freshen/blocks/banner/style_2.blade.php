<div class="banner-slide-4 mt30 mt70-992 bgc-f5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 dn-lg">
                <div class="mega_button_dropdown_menu active home4_style">
                    @php generate_menu('department',['walker'=>\Themes\Freshen\Walkers\DepartmentMenuWalker::class,'class'=>'home4_style']) @endphp
                </div>
            </div>
            <div class="col-lg-8 col-xl-6 pr0 pr15-md">
                <div class="main-banner-wrapper home4_main_slider mb30-md">
                    <div class="banner-style-one owl-theme owl-carousel">
                        @foreach($sliders as $slider)
                            <div class="slide slide-one" style="background-image: url({{ get_file_url($slider['image']?? false,'full') }});height: 370px;">
                            <div class="container">
                                <div class="row home-content">
                                    <div class="col-lg-12 p0">
                                        @if(!empty($slider['sub_title']))
                                            <p class="fwb ttu text-white">{!! $slider['sub_title'] !!}}</p>
                                        @endif
                                        <h3 class="banner-title text-white"><span>{!! $slider['title'] !!}</span><br>
                                            @if(!empty($slider['sub_text']))
                                                <span class="fwb">{!! $slider['sub_text'] !!}</span>
                                            @endif
                                        </h3>
                                        <a href="{{ $slider['link_shop_now'] }}" class="btn p0">
                                            <button class="banner-btn btn-thm">{{ $slider['btn_shop_now'] }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- /.main-banner-wrapper -->
                <div class="row">
                    @foreach($sliders_2 as $key => $slider_2)
                        @if($key < 2)
                        <div class="col-md-6 col-lg-6 pr0 pr15-md">
                            <div class="category_list_box home4_style mb0 mb30-md bgc-white">
                                <h5 class="title text-thm2">{{ $slider_2['title'] }} <br>
                                    @if(!empty($slider_2['sub_title']))
                                        <span class="text-thm fwb">{!! $slider_2['sub_title'] !!}</span>
                                    @endif
                                </h5>
                                <a href="{{ $slider['link_shop_now'] }}" class="shop_btn style2">{{ $slider['btn_shop_now'] }}</a>
                                <div class="thumb"><img src="{{ get_file_url($slider_2['image']?? false,'full') }}" alt="{{ $slider_2['title'] }}"></div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 pl0 pl15-md">
                @foreach($sliders_2 as $key => $slider_2)
                    @if($key > 1)
                        <div class="category_list_box home4_style mb0 mb30-md bgc-white">
                            <h5 class="title text-thm2">{{ $slider_2['title'] }} <br>
                                @if(!empty($slider_2['sub_title']))
                                    <span class="text-thm fwb">{!! $slider_2['sub_title'] !!}</span>
                                @endif
                            </h5>
                            <a href="{{ $slider['link_shop_now'] }}" class="shop_btn style2">{{ $slider['btn_shop_now'] }}</a>
                            <div class="thumb"><img class="w60" src="{{ get_file_url($slider_2['image']?? false,'full') }}" alt="{{ $slider_2['title'] }}"></div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
