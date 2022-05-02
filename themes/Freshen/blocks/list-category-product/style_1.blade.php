<section class="featured-product pt0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="main-title text-center">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="popular_listing_sliders row">
                    <!-- Nav tabs -->
                    @if(!empty($categories))
                        <div class="nav nav-tabs mb30 col-lg-12 justify-content-center" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</button>
                            @foreach($categories as $item)
                                <button class="nav-link" id="nav-shopping-tab" data-bs-toggle="tab" data-bs-target="#nav-cat-{{ $item->id }}" role="tab" aria-controls="nav-cat-{{ $item->id }}" aria-selected="false">
                                    {{ $item->translate()->name }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                    <!-- Tab panes -->
                    <div class="tab-content col-lg-12" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            @if(!empty($rows))
                                <div class="popular_listing_slider1">
                                    @foreach($rows as $row)
                                        <div class="item">
                                            @include('product.search.loop-1')
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @foreach($categories as $item)
                            <div class="tab-pane fade" id="nav-cat-{{ $item->id }}" role="tabpanel" aria-labelledby="nav-cat-{{ $item->id }}-tab">
                                @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp
                                @if(!empty($list_items))
                                    <div class="popular_listing_slider1">
                                        @foreach($list_items as $row)
                                            @include('product.search.loop-1',['row'=>$row])
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
</section>