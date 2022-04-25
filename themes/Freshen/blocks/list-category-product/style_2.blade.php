<div class="our-shops pb0 pt30 bgc-f5">
    <div class="container">
        <div class="fruit_custom_widget">
            <div class="main-title">
                <div class="row pl30 pl0-md pr30 pr0-md mb30">
                    <div class="col-xl-3">
                        <h3 class="ttc">{{ $title }}</h3>
                    </div>
                    <div class="col-xl-9">
                        <div class="popular_listing_sliders home4_style">
                            <!-- Nav tabs -->
                            @if(!empty($categories))
                            <div class="nav nav-tabs justify-content-center" role="tablist">
                                @foreach($categories as $item)
                                    <button class="nav-link active" id="nav-{{ $item->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $item->id }}" role="tab" aria-controls="nav-{{ $item->id }}" aria-selected="true">
                                        <span class="flaticon-harvest mr5"></span> {{ $item->translate()->name }}</button>
                                @foreach
                            </div>
                            @endif
                            <!-- Tab panes -->
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_listing_sliders home4_style row pb30">
                        <div class="tab-content col-lg-12" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-fruit" role="tabpanel" aria-labelledby="nav-fruit-tab">
                                @if(!empty($rows))
                                    <div class="feature_product_slider nav_none">
                                        @foreach($rows as $row)
                                            <div class="item">
                                                @include('product.search.loop-3')
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @foreach($categories as $item)
                                <div class="tab-pane fade" id="nav-{{ $item->id }}" role="tabpanel" aria-labelledby="nav-{{ $item->id }}-tab">
                                    @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp
                                    @if(!empty($list_items))
                                        <div class="feature_product_slider nav_none">
                                            @foreach($list_items as $row)
                                                @include('product.search.loop-3',['row'=>$row])
                                            @endforeach
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
