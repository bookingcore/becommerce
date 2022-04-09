{{--Axtronic promotions--}}
<div class="axtronic-promotions pb-5">
    <div class="container">
        <div class="mb-4">
            <h3 class="fs-24 mb-1">{{ $title }}</h3>
            <span class="fs-16">{{ $sub_title }}</span>
        </div>
        <div class="row">
            @foreach($list_items as $item)
                @if($col == 'grid')
                    <div class="col-md-3">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ theme_url('Axtronic/images/banner1.jpg') }});"></div>
                            <div class="item-content d-flex align-content-start align-items-start flex-column  justify-content-end">
                                <span class="sub-title">Sound</span>
                                <h3>Headphone</h3>
                                <p>
                                    <span>Start from</span>
                                    <br>$699.00
                                </p>
                                <a href="#" class="item-button">Shop Now <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ theme_url('Axtronic/images/banner2.jpg') }});"></div>
                            <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-end">
                                <span class="sub-title">Sound</span>
                                <h3>Headphone</h3>
                                <p>
                                    <span>Start from</span>
                                    <br>$699.00
                                </p>
                                <a href="#" class="item-button">Shop Now <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ theme_url('Axtronic/images/banner3.jpg') }});"></div>
                            <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-end">
                                <span class="sub-title">Sound</span>
                                <h3>Headphone</h3>
                                <p>
                                    <span>Start from</span>
                                    <br>$699.00
                                </p>
                                <a href="#" class="item-button">Shop Now <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ theme_url('Axtronic/images/banner4.jpg') }});"></div>
                            <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-start">
                                <span class="sub-title">Sound</span>
                                <h3>Headphone</h3>
                                <p>
                                    <span>Start from</span>
                                    <br>$699.00
                                </p>
                                <a href="#" class="item-button">Shop Now <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ theme_url('Axtronic/images/banner5.jpg') }});"></div>
                            <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-start">
                                <span class="sub-title">Sound</span>
                                <h3>Headphone</h3>
                                <p>
                                    <span>Start from</span>
                                    <br>$699.00
                                </p>
                                <a href="#" class="item-button">Shop Now <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="promotions-item">
                            <div class="item-bg" style="background-image: url({{ theme_url('Axtronic/images/banner6.jpg') }});"></div>
                            <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-start">
                                <span class="sub-title">Sound</span>
                                <h3>Headphone</h3>
                                <p>
                                    <span>Start from</span>
                                    <br>$699.00
                                </p>
                                <a href="#" class="item-button">Shop Now <i class="axtronic-icon-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                @else
                    @php
                        switch ($col){
                            case '4': $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            case '3': $colClass = "col-xl-$col col-lg-$col col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            default: $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4";
                        }
                    @endphp
                    <div class="{{ $colClass }} mb-xl-0 mb-4">
                        <a class="bc-collection" href="{{ $item['link'] ?? '' }}">
                            <img  class="img-fluid w-100" src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                        </a>
                    </div>
                @endif

            @endforeach

        </div>
    </div>
</div>

