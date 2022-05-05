<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/5/2022
 * Time: 8:32 AM
 */

?>
<div class="axtronic-list-products py-5 mb-5 {{ $style_header }} " style="background-image: url('{{ get_file_url( $bg_content ?? false,'full') }}')">
    <div class="container">
        <div class="product-box-title ">
            <h2 class="heading-title {{ $is_dark ? "dark" : 'light' }}">{!! clean($title) !!}</h2>
            <ul class="list-unstyled list-category-name">
                <li><a href="/product" class="button">{{ $style_header == 'style_2' ? "View all" : "See all" }}</a></li>
            </ul>
        </div>
        <ul class="nav list-items list-product-items axtronic-products-special">
            @if(!empty($rows))
                @foreach($rows as $key => $row)
                   @if($key == 0)
                        <li class="list-item product-style-2">
                            <div class="product-block">
                                <span class="hot-title">{{__("Hot Offer")}}</span>
                                @include('product.search.loop')
                            </div>
                        </li>
                   @else
                        <li class="list-item product-style-1">
                            @include('product.search.loop-1')
                        </li>
                   @endif
                @endforeach
            @endif

        </ul>
    </div>
</div>
