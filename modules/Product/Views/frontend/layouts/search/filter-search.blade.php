<div class="bravo-filter">
    <div class="g-filter-item">
        <div class="item-title">
            <h4>{{__("BY PRICE")}}</h4>
        </div>
        <div class="item-content">
            <div class="bravo-filter-price">
				<?php
				$currency = App\Currency::getCurrency(setting_item('currency_main'));?>
                <div class="price_slider"></div>
                <div class="bravo-filter-price-amount" data-step="10">
                    <input type="text" id="min_price" name="min_price" value="380" data-min="10" placeholder="Min price" style="display: none;">
                    <input type="text" id="max_price" name="max_price" value="1050" data-max="1260" placeholder="Max price" style="display: none;">
                    <button type="submit" class="button d-sm-block d-md-none">{{__('Filter')}}</button>
                    <div class="price_label">
                        {{__('Price')}}: {{$currency['symbol']}}<span class="from"></span> — <span class="to"></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="g-filter-item">
        <div class="item-title">
            <h4>{{__("BY COLOR")}}</h4>
        </div>
        <div class="item-content">
            <div class="bravo-filter-color">
                <ul class="list-unstyled">
                    <li class="">
                        <a href="#">
                            <span class="swatch swatch-color" title="Blue" data-toggle="tooltip">
                                <span class="sub-swatch" style="background-color:blue;"></span>
                                <span class="term-name d-sm-block d-md-none">Blue</span>
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <span class="swatch swatch-color" title="Black" data-toggle="tooltip">
                                <span class="sub-swatch" style="background-color:#000000;"></span>
                                <span class="term-name d-sm-block d-md-none">Black</span>
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <span class="swatch swatch-color" title="Red" data-toggle="tooltip">
                                <span class="sub-swatch" style="background-color:red;"></span>
                                <span class="term-name d-sm-block d-md-none">Red</span>
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <span class="swatch swatch-color" title="Yellow" data-toggle="tooltip">
                                <span class="sub-swatch" style="background-color:yellow;"></span>
                                <span class="term-name d-sm-block d-md-none">Yellow</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="g-filter-item">
        <div class="item-title">
            <h4>{{__("BY SIZE")}}</h4>
        </div>
        <div class="item-content">
            <div class="bravo-filter-size">
                <ul class="list-unstyled">
                    <li class="">
                        <a data-toggle="tooltip" data-title="L" href="#">
                            <span class="swatch swatch-label">L</span>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tooltip" data-title="L" href="#">
                            <span class="swatch swatch-label">L</span>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tooltip" data-title="M" href="#">
                            <span class="swatch swatch-label">M</span>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tooltip" data-title="S" href="#">
                            <span class="swatch swatch-label">S</span>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tooltip" data-title="XL" href="#">
                            <span class="swatch swatch-label">XL</span>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tooltip" data-title="XXL" href="#">
                            <span class="swatch swatch-label">XXL</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="g-filter-item">
        <div class="item-title">
            <h4>{{__("BY REVIEW")}}</h4>
        </div>
        <div class="item-content">
            <div class="bravo-filter-checkbox bravo-filter-reviews">
                <ul>
                    <li class="active">
                        <a href="#">
                            <span class="star-rating">
                                <span style="width:100%">Rated <strong class="rating">5</strong> out of 5</span>
                            </span> (13)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @if(!empty($brands))
        @php
            $selected = (array) Request::query('brand_is');
        @endphp
        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("By Brands")}}</h4>
            </div>
            <div class="item-content">
                <div class="bravo-filter-checkbox">
                    <div class="search_layered_nav"><input type="text" class="mf-input-search-nav"></div>
                    <ul class="bravo-custom-scroll">
                        @foreach($brands as $item=>$brand)
                            @php($translate= $brand->translateOrOrigin(app()->getLocale()))
                            <li class="active">
                                <a href="#">{{$translate->name}}</a>
                                <span class="count">({{$brand->count_product}})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>