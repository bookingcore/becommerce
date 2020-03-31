<div class="bravo-filter">
    <form action="{{ route("product.index") }}" class="bravo_form_filter">
        <aside id="primary-sidebar" class="widgets-area primary-sidebar catalog-sidebar">
            <div id="mf_product_categories-2" class="widget mf_widget_product_categories">
                <h4 class="widget-title">{{__('Categories')}}</h4>
                <ul class="product-categories">
                    @if(!empty($categories))
                        @php
                            $traverse = function ($categories, $prefix = '') use (&$traverse) {
                                foreach ($categories as $category) {
                                    $translate = $category->translateOrOrigin(app()->getLocale());
                                    if(empty($prefix)){
                                        echo '<li class="cat-item">';
                                        echo '<a href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                                        if(count($category->children) > 0){
                                            echo '<span class="cat-menu-close"><i class="icon-chevron-down"></i></span>';
                                        }
                                    }else{
                                        echo '<li class="cat-item">';
                                        echo '<a href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                                    }
                                    if(count($category->children) > 0){
                                        echo '<ul class="children">';
                                            $traverse($category->children, 1);
                                        echo '</ul>';
                                    }
                                    echo '</li>';
                                }
                            };
                            $traverse($categories);
                        @endphp
                    @endif
                </ul>
            </div>
        </aside>
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
                        <ul class="bravo-custom-scroll list-unstyled">
                            @foreach($brands as $item=>$brand)
                                @php $translate= $brand->translateOrOrigin(app()->getLocale()) @endphp
                                <li>
                                    <a href="#">{{$translate->name}}</a>
                                    <span class="count">({{$brand->count_product}})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("BY PRICE")}}</h4>
            </div>
            <div class="item-content">
                <div class="bravo-filter-price">
                    <?php
                    $price_min = $pri_from = $product_min_max_price[0];
                    $price_max = $pri_to = $product_min_max_price[1];
                    if (!empty($price_range = Request::query('price_range'))) {
                        $pri_from = explode(";", $price_range)[0];
                        $pri_to = explode(";", $price_range)[1];
                    }
                    $currency = App\Currency::getCurrency(setting_item('currency_main'));?>
                    <div class="price_slider"></div>
                    <div class="bravo-filter-price-amount" data-step="10">
                        <input type="text" id="min_price" name="min_price" class="d-none" value="{{$price_min}}"
                               data-min="{{$price_min}}">
                        <input type="text" id="max_price" name="max_price" class="d-none" value="{{$price_max}}"
                               data-max="{{$price_max}}">
                        <button type="submit" class="button d-sm-block d-md-none">{{__('Filter')}}</button>
                        <div class="price_label">
                            {{__('Price')}}: {{$currency['symbol']}}<span class="from">{{($price_min)}}</span> — <span
                                class="to">{{($price_max)}}</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("BY REVIEW")}}</h4>
            </div>
            <div class="item-content">
                <div class="bravo-filter-reviews">
                    <ul>
                        <li class="wc-layered-nav-rating">
                            <a href="#">
                                <span class="star-rating"><span style="width:100%">Rated <strong
                                            class="rating">5</strong> out of 5</span></span>(2)
                            </a>
                        </li>
                        <li class="wc-layered-nav-rating">
                            <a href="#">
                                <span class="star-rating"><span style="width:80%">Rated <strong
                                            class="rating">4</strong> out of 5</span></span>(2)
                            </a>
                        </li>
                        <li class="wc-layered-nav-rating">
                            <a href="#">
                                <span class="star-rating"><span style="width:60%">Rated <strong
                                            class="rating">3</strong> out of 5</span></span>(1)
                            </a>
                        </li>
                        <li class="wc-layered-nav-rating">
                            <a href="http://demo2.drfuri.com/martfury3/product-category/garden-kitchen/?rating_filter=2">
                                <span class="star-rating"><span style="width:40%">Rated <strong
                                            class="rating">2</strong> out of 5</span></span>(1)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @php
            $selected = (array) Request::query('terms');
        @endphp
        @foreach ($attributes as $item)
            @php
                $translate = $item->translateOrOrigin(app()->getLocale());
            @endphp
            <div class="g-filter-item">
                <div class="item-title">
                    <h4> {{$translate->name}} </h4>
                </div>
                <div class="item-content">
                    <ul class="list-unstyled">
                        @foreach($item->terms as $key => $term)
                            @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                            <li @if($key > 2 and empty($selected)) @endif>
                                <div class="bravo-checkbox">
                                    <label>
                                        <input @if(in_array($term->id,$selected)) checked @endif type="checkbox"
                                               name="terms[]" value="{{$term->id}}"> {!! $translate->name !!}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </form>
</div>
