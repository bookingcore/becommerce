<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/27/2022
 * Time: 3:44 PM
 */
?>

<section class="banner-product">
    <div class="container">
        @if(!empty($title_header))
            <div class="main-title text-left">
                <h2>{{ $title_header }}</h2>
            </div>
        @endif
        <div class="row ">
            <div class="col-sm-6 {{$position == 'left' ? 'order-2' : ''}}">
                <div class="row">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                            <div class="col-lg-6 col-sm-6">
                                @include('product.search.loop')
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-sm-6 {{$position == 'left' ? 'order-1' : ''}}">
                <div class="axtronic-promotions ">
                    <div class="promotions-item ">
                        <div class="item-bg" style="background-image: url({{ get_file_url($image , "full") }});"></div>
                        <div class="item-content d-flex flex-column align-items-start justify-content-start">
                            <h3>{!! $title !!}</h3>
                            <span class="sub-content">{{ $sub_title }}</span>
                            <p>
                                {!! $sub_text !!}
                            </p>
                            <a href="{{ $link_shop_now }}" class="item-button">{{ $btn_shop_now }} <i class="axtronic-icon-angle-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
