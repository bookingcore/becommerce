@if(!empty($list_items))
<div class="axtronic-site-features pt-5 pb-5">
    <div class="container">
        <div class="row">
            @foreach($list_items as $item)
            <div class="col-xl-3 col-lg-6 col-sm-6 mb-xl-0 mb-4">
                <div class="d-flex align-items-center justify-content-center box">
                    <div class="item-icon">
                        <i class="{{$item['icon'] ?? 'axtronic-icon-group'}}"></i>
                    </div>
                    <div class="ms-3">
                        <h4 >{{ $item['title'] ?? '' }}</h4>
                        <p class="mb-0">{{$item['sub_title'] ?? ''}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
{{--Axtronic Category--}}

<div class="axtronic-category">
    <div class="container">
        <h2 class="heading-title">Category</h2>
        <div class="swiper-slider-icon swiper-container ">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
                <div class="swiper-slide">
                    <div class="item-icons">
                        <a href="#">
                            <i class="axtronic-icon-monitor-mobbile"></i>
                        </a>
                    </div>
                    <h3 class="item-title"><a href="#">Laptop, PC, Monitor </a></h3>
                </div>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>
</div>
