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
                <div class="product-box-title ">
                    <h2 class="heading-title ">{!! clean($title) !!}</h2>
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

