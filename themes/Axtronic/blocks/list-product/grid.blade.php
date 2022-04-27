<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/26/2022
 * Time: 4:51 PM
 */
?>
@if(!empty($rows->count()))
    <div class="axtronic-list-products my-5 {{ $style_header }}">
        <div class="container">
            <div class="product-box">
                <div class="product-box-title mb-4">
                    <h2 class="heading-title">{!! clean($title) !!}</h2>
                    @if($categories)
                        <ul class="list-unstyled list-category-name">
                            @foreach($categories as $category)
                                <li><a href="/category/{{$category['slug']}}" class="button">{{$category['name']}}</a></li>
                            @endforeach
                            <li><a href="/product" class="button">{{ $style_header == 'style_2' ? "View all" : "See all" }}</a></li>
                        </ul>
                    @endif
                </div>
                <div class="axtronic-content">
                    <div class="row">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="col-lg-4 col-sm-6 mb-3">
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


