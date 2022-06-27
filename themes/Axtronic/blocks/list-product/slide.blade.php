@if(!empty($rows->count()))
    <div class="axtronic-list-products {{ $style_header }}">
        <div class="container">
            <div class="product-box">
                <div class="product-box-title {{ $style_header }} {{ $is_category ? "show-category" : '' }} {{ $is_dark ? "dark" : 'light' }}">
                    <h2 class="heading-title ">{!! clean($title) !!}</h2>
                    @if($is_category)
                        <ul class="list-unstyled list-category-name">
                            @foreach($categories as $category)
                                <li><a href="/category/{{$category['slug']}}" class="button">{{$category['name']}}</a></li>
                            @endforeach
                            <li><a href="/product" class="button">{{ $style_header == 'style_2' ? "View all" : "See all" }}</a></li>
                        </ul>
                    @endif
                </div>
                <div class="axtronic-slider-content">
                    <div class="product-slider swiper-container">
                        <div class="swiper-wrapper">
                            @if(!empty($rows))
                                @foreach($rows as $row)
                                    <div class="swiper-slide">
                                        @include('product.search.loop')
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-pagination-slider swiper-pagination"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

{{--@include('blocks.list-product.special')--}}
