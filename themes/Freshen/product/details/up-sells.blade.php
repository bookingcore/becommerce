@if(count($row->up_sell))
    <!-- Our Shopping Product -->
    <section class="our-shop bt1 pb20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        <h2>{{ __("YOU MAY ALSO LIKE") }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recent_property_slider_home5">
                        @foreach($row->up_sell as $row)
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
