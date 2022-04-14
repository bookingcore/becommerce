@if($products_related->count())
    <!-- Our Shopping Product -->
    <section class="our-shop bt1 pb20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        <h2>{{ __("RELATED PRODUCTS") }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recent_property_slider_home5">
                        @foreach($products_related as $row)
                            <div class="item">
                                @include('product.search.loop-1')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
