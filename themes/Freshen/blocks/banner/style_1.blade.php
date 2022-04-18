<section class="home-one mt30 mt70-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="main-banner-wrapper home2_main_slider mb30-md">
                    <div class="banner-style-one owl-theme owl-carousel">
                        @foreach($sliders as $slider)
                        <div class="slide slide-one" style="background-image: url(images/banner/5.jpg);height: 530px;">
                            <div class="container">
                                <div class="row home-content tac-sm">
                                    <div class="col-lg-12 p0">
                                        <p class="fwb ttu text-thm2">All natural products </p>
                                        <h3 class="banner-title text-thm2 ttu"><span class="fwb">Get fresher food</span><br><span class="text-thm fw400">every days</span></h3>
                                        <p class="text-thm2 dn-sm"><span class="fwb">Organic food</span> is food produced by methods that comply with the <br> standards of organic farming.</p>
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
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="banner_one home2_style">
                    <div class="thumb"><img src="images/banner/6.jpg" alt="6.jpg"></div>
                    <div class="details style2">
                        <p class="para">Seasonal Sale</p>
                        <h2 class="title">Up To Breads <span class="text-thm2">50% Off</span></h2>
                        <a href="page-shop-list-v1.html" class="shop_btn style2">SHOP NOW</a>
                    </div>
                </div>
                <div class="banner_one home2_style">
                    <div class="thumb"><img src="images/banner/7.jpg" alt="7.jpg"></div>
                    <div class="details style2">
                        <p class="para">Tasty Healthy</p>
                        <h2 class="title">Fresh Vegetables</h2>
                        <a href="page-shop-list-v1.html" class="shop_btn style2">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
