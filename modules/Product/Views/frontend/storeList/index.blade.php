@extends('Layout::app')
@section('content')
{{--    @dump($users)--}}
    <div class="ps-store-list">
        <h1 class="entry-title">{{ __('Store list') }}</h1>
        <div class="site-content">
            <div class="container">
                <div class="ps-section__wrapper">
                    <div class="ps-section__left">
                        <aside class="widget widget--vendor">
                            <h3 class="widget-title">Search</h3>
                            <input class="form-control" type="text" placeholder="Search...">
                        </aside>
                        <aside class="widget widget--vendor">
                            <h3 class="widget-title">Filter by Category</h3>
                            <div class="form-group">
                                <select class="ps-select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="3">Lighting</option>
                                    <option data-select2-id="30">Exterior</option>
                                    <option data-select2-id="31">Custom Grilles</option>
                                    <option data-select2-id="32">Wheels &amp; Tires</option>
                                    <option data-select2-id="33">Performance</option>
                                </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 126px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-v297-container"><span class="select2-selection__rendered" id="select2-v297-container" role="textbox" aria-readonly="true" title="Lighting">Lighting</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </aside>
                        <aside class="widget widget--vendor">
                            <h3 class="widget-title">Filter by Location</h3>
                            <div class="form-group">
                                <select class="ps-select select2-hidden-accessible" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="6">Chooose Location</option>
                                    <option data-select2-id="20">Exterior</option>
                                    <option data-select2-id="21">Custom Grilles</option>
                                    <option data-select2-id="22">Wheels &amp; Tires</option>
                                    <option data-select2-id="23">Performance</option>
                                </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="5" style="width: 147px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-pec4-container"><span class="select2-selection__rendered" id="select2-pec4-container" role="textbox" aria-readonly="true" title="Chooose Location">Chooose Location</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                            <div class="form-group">
                                <select class="ps-select select2-hidden-accessible" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="9">Chooose State</option>
                                    <option data-select2-id="25">Exterior</option>
                                    <option data-select2-id="26">Custom Grilles</option>
                                    <option data-select2-id="27">Wheels &amp; Tires</option>
                                    <option data-select2-id="28">Performance</option>
                                </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="8" style="width: 126px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-rhs7-container"><span class="select2-selection__rendered" id="select2-rhs7-container" role="textbox" aria-readonly="true" title="Chooose State">Chooose State</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search by City">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search by ZIP">
                            </div>
                        </aside>
                    </div>
                    <div class="ps-section__right">
                        <section class="ps-store-box">
                            <div class="ps-section__header">
                                <p>Showing 1 -8 of 22 results</p>
                                <select class="ps-select">
                                    <option value="1" data-select2-id="12">Sort by Newest: old to news</option>
                                    <option value="2" data-select2-id="17">Sort by Newest: New to old</option>
                                    <option value="3" data-select2-id="18">Sort by average rating: low to hight</option>
                                </select>
                            </div>
                            <div class="ps-section__content">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <article class="ps-block--store">
                                            <div class="ps-block__thumbnail bg--cover" data-background="img/vendor/store/1.jpg" style="background: url(&quot;img/vendor/store/1.jpg&quot;);"></div>
                                            <div class="ps-block__content">
                                                <div class="ps-block__author"><a class="ps-block__user" href="#"><img src="img/vendor/store/user/3.jpg" alt=""></a><a class="ps-btn" href="#">Visit Store</a></div>
                                                <h4>GoPro</h4>
                                                <div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" data-read-only="true" style="display: none;">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><div class="br-widget br-readonly"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="5"></a><div class="br-current-rating">1</div></div></div>
                                                <p>325 Orchard, Buenos Aires, Formosa Argentina</p>
                                                <ul class="ps-block__contact">
                                                    <li><i class="icon-envelope"></i><a href="mailto:contact@xhome.com">contact@xhome.com</a></li>
                                                    <li><i class="icon-telephone"></i> (+093) 77-637-3300</li>
                                                </ul>
                                                <div class="ps-block__inquiry"><a href="#"><i class="icon-question-circle"></i> inquiry</a></div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <article class="ps-block--store">
                                            <div class="ps-block__thumbnail bg--cover" data-background="img/vendor/store/2.jpg" style="background: url(&quot;img/vendor/store/2.jpg&quot;);"></div>
                                            <div class="ps-block__content">
                                                <div class="ps-block__author"><a class="ps-block__user" href="#"><img src="img/vendor/store/user/4.jpg" alt=""></a><a class="ps-btn" href="#">Visit Store</a></div>
                                                <h4>Robert's Store</h4>
                                                <div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" data-read-only="true" style="display: none;">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><div class="br-widget br-readonly"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="5"></a><div class="br-current-rating">1</div></div></div>
                                                <p>325 Orchard, Buenos Aires, Formosa Argentina</p>
                                                <ul class="ps-block__contact">
                                                    <li><i class="icon-envelope"></i><a href="mailto:contact@xhome.com">contact@xhome.com</a></li>
                                                    <li><i class="icon-telephone"></i> (+093) 77-637-3300</li>
                                                </ul>
                                                <div class="ps-block__inquiry"><a href="#"><i class="icon-question-circle"></i> inquiry</a></div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <article class="ps-block--store">
                                            <div class="ps-block__thumbnail bg--cover" data-background="img/vendor/store/3.jpg" style="background: url(&quot;img/vendor/store/3.jpg&quot;);"></div>
                                            <div class="ps-block__content">
                                                <div class="ps-block__author"><a class="ps-block__user" href="#"><img src="img/vendor/store/user/5.jpg" alt=""></a><a class="ps-btn" href="#">Visit Store</a></div>
                                                <h4>Youngshop</h4>
                                                <div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" data-read-only="true" style="display: none;">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><div class="br-widget br-readonly"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="5"></a><div class="br-current-rating">1</div></div></div>
                                                <p>325 Orchard, Buenos Aires, Formosa Argentina</p>
                                                <ul class="ps-block__contact">
                                                    <li><i class="icon-envelope"></i><a href="mailto:contact@xhome.com">contact@xhome.com</a></li>
                                                    <li><i class="icon-telephone"></i> (+093) 77-637-3300</li>
                                                </ul>
                                                <div class="ps-block__inquiry"><a href="#"><i class="icon-question-circle"></i> inquiry</a></div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <article class="ps-block--store">
                                            <div class="ps-block__thumbnail bg--cover" data-background="img/vendor/store/1.jpg" style="background: url(&quot;img/vendor/store/1.jpg&quot;);"></div>
                                            <div class="ps-block__content">
                                                <div class="ps-block__author"><a class="ps-block__user" href="#"><img src="img/vendor/store/user/5.jpg" alt=""></a><a class="ps-btn" href="#">Visit Store</a></div>
                                                <h4>Global Offical</h4>
                                                <div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" data-read-only="true" style="display: none;">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><div class="br-widget br-readonly"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="5"></a><div class="br-current-rating">1</div></div></div>
                                                <p>325 Orchard, Buenos Aires, Formosa Argentina</p>
                                                <ul class="ps-block__contact">
                                                    <li><i class="icon-envelope"></i><a href="mailto:contact@xhome.com">contact@xhome.com</a></li>
                                                    <li><i class="icon-telephone"></i> (+093) 77-637-3300</li>
                                                </ul>
                                                <div class="ps-block__inquiry"><a href="#"><i class="icon-question-circle"></i> inquiry</a></div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div class="ps-pagination">
                                    <ul class="pagination">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

