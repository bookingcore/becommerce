<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/21/2022
 * Time: 9:03 AM
 */
$bg_image = "";
if (!empty($bg_content)){
    $bg_image = get_file_url( $bg_content ?? false,'full');
}
?>
@if(!empty($rows->count()))
    <div class="axtronic-list-products list-products-bg" style="background-image: url('{{ $bg_image }}')">
        <div class="container">
            <div class="product-box">
                <div class="product-box-title {{ $is_dark ? "dark" : 'light' }} {{ $style_header }} {{ $is_category ? "show-category" : '' }}">
                    <h2 class="heading-title ">{!! clean($title) !!}</h2>
                    @if($is_category)
                        <ul class="list-unstyled list-category-name">
                            @foreach($categories as $category)
                                <li><a href="/category/{{$category['slug']}}" class="button">{{$category['name']}}</a></li>
                            @endforeach
                            <li>
                                <a href="/product" class="button">
                                    {{ $style_header == 'style_2' ? "View all" : "See all" }}

                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
                <div class="axtronic-slider-content">
                    <div class="product-slider-bestselling product-slider swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($rows as $row)
                                <div class="swiper-slide axtronic-loop-product">
                                    @include('product.search.loop')
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
