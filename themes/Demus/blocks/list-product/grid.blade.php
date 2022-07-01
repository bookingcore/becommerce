<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 4:51 PM
 */
?>
@if(!empty($rows->count()))
    <div class="axtronic-list-products style-grid">
        <div class="container">
            <div class="product-box">
                <div class="product-box-title {{ $style_header }} {{ $is_category ? "show-category" : '' }}">
                    <h2 class="heading-title {{ $is_dark ? "dark" : 'light' }}">{!! clean($title) !!}</h2>
                    @if($is_category)
                        <ul class="list-unstyled list-category-name">
                            @foreach($categories as $category)
                                <li><a href="/category/{{$category['slug']}}" class="button">{{$category['name']}}</a></li>
                            @endforeach
                            <li><a href="/product" class="button">{{__("View all ")}}<i aria-hidden="true" class="axtronic-icon- axtronic-icon-angle-right"></i></a></li>
                        </ul>
                    @endif
                </div>
                <div class="axtronic-content">
                    <div class="row">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="col-lg-4 col-sm-6  axtronic-loop-product">
                                    @include('product.search.loop-1')
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif


