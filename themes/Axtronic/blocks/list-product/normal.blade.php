<?php
    $bg_image = "";
    if (!empty($bg_content)){
        $bg_image = get_file_url( $bg_content ?? false,'full');
    }
?>

@if(!empty($rows->count()))
    <div class="axtronic-list-products axtronic-normal">
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
                                <div class="col-lg-3 col-sm-6 axtronic-loop-product">
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

