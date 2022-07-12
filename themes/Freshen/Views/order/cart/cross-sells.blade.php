<?php $cross_sells =  $cart->getCrossSells();?>
@if(count($cross_sells))
    <!-- Our Shopping Product -->
    <section class="our-shop bt1 pb20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        <h2>{{ __("YOU MAY BE INTERESTED IN:") }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($cross_sells as $row)
                    <div class="col-sm-3 mb-3">
                        @include("product.search.loop")
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
