<div class="bravo-filter">
    <div class="filter-header">
        <div class="mf-catalog-close-sidebar" id="mf-catalog-close-sidebar">
            <h2>{{ __('Filter Products') }}</h2>
            <a class="close-sidebar"><i class="icon-cross"></i></a>
        </div>
    </div>
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
                $selected = (array) Request::query('brand');
            @endphp
            <div class="g-filter-item">
                <div class="item-title">
                    <h4>{{__("By Brands")}}</h4>
                </div>
                <div class="item-content">
                    <div class="bravo-filter-checkbox">
                        <ul class="bravo-custom-scroll list-unstyled">
                            @foreach($brands as $item=>$brand)
                                @php $translate = $brand->translateOrOrigin(app()->getLocale()) @endphp
                                <li>
                                <div class="bravo-checkbox">
                                    <label>
                                        <input @if(in_array($brand->id,$selected)) checked @endif type="checkbox" name="brand[]" value="{{$brand->id}}"> {!! $translate->name !!}
                                            <span class="checkmark"></span>
                                    </label>
                                </div>
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
                    $price_min = $pri_from = floor ( ($product_min_max_price[0]) );
                    $price_max = $pri_to = ceil ( ($product_min_max_price[1]) );
                    if (!empty($min_price = Request::query('min_price'))) {
                        $pri_from = $min_price;
                    }
                    if (!empty($max_price = Request::query('max_price'))) {
                        $pri_to = $max_price;
                    }
                    $currency = App\Currency::getCurrency(setting_item('currency_main'));?>
                    <div class="price_slider"  data-from="{{$pri_from}}" data-to="{{$pri_to}}"></div>
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
                    <input type="submit" class="bravo-price-submit" title="{{__('APPLY')}}" value="{{__('APPLY')}}">
                </div>
            </div>
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("BY REVIEW")}}</h4>
            </div>
            <div class="item-content">

                <div class="bravo-filter-reviews">
                    <ul class="list-unstyled">
                        @for ($number = 5 ;$number >= 1 ; $number--)
                            <li>
                                <div class="bravo-checkbox">
                                    <label>
                                        <input name="review_score[]" type="checkbox" value="{{$number}}" @if(  in_array($number , request()->query('review_score',[])) )  checked @endif>
                                        <span class="checkmark"></span>
                                        @for ($review_score = 1 ;$review_score <= $number ; $review_score++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </label>
                                </div>
                            </li>
                        @endfor
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
