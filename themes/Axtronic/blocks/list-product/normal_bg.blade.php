<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/21/2022
 * Time: 9:01 AM
 */
?>
@if(!empty($rows->count()))
    <div class="axtronic-list-products axtronic-slider-best list-products-bg mb-5 py-5 {{ $style_header }}"  style="background-image: url('{{ get_file_url( $bg_content ?? false,'full') }}')">
        <div class="container">
            <div class="product-box">
                <div class="product-box-title ">
                    <h2 class="heading-title {{ $is_dark ? "dark" : 'light' }}">{!! clean($title) !!}</h2>
                    @if($categories)
                        <ul class="list-unstyled list-category-name">
                            @foreach($categories as $category)
                                <li><a href="/category/{{$category['slug']}}" class="button">{{$category['name']}}</a></li>
                            @endforeach
                            <li><a href="/product" class="button">{{ $style_header == 'style_2' ? "View all" : "See all" }}</a></li>
                        </ul>
                    @endif
                </div>
                <div class="axtronic-slider-content">
                    <div class="row">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="col-lg-3 col-sm-6 mb-3">
                                    @include('product.search.loop')
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

