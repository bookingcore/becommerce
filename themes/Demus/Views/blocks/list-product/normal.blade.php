<?php
    $bg_image = "";
    if (!empty($bg_content)){
        $bg_image = get_file_url( $bg_content ?? false,'full');
    }
?>

@if(!empty($rows->count()))
    <div class="demus-list-products demus-normal">
        <div class="container">
            <div class="product-box">
                @if(!empty($title))
                    <div class="box-heading-title text-center mb-xl-3 pb-4">
                        <h2 class="heading-title ">{!! clean($title) !!}</h2>
                        <p class="sub-heading">{!! clean($sub_title) !!}</p>
                    </div>
                @endif
                <div class="demus-content">
                    <div class="row">
                        @if(!empty($rows))
                            @foreach($rows as $row)
                                <div class="col-lg-3 col-sm-6 demus-loop-product">
                                    @include('product.search.loop')
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="text-center pt-3">
                        <a class="btn--viewall btn-link-outline p-0 text-uppercase" href="/shop" title="See All Products"><span>{{__('See All Products')}}</span></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

