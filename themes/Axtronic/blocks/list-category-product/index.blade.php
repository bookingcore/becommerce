<section class="featured-product pb-5">
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
                <div class="popular_listing_tabs {{$style}}">
                    <!-- Nav tabs -->
                    @if(!empty($categories))
                        <div class="nav nav-tabs {{$style == 'style_1'? "justify-content-start":"justify-content-center"}}" role="tablist">
                            @foreach($categories as $key => $item)
                                <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="nav-shopping-tab" data-bs-toggle="tab" data-bs-target="#nav-cat-{{ $item->id }}" role="tab" aria-controls="nav-cat-{{ $item->id }}" aria-selected="false">
                                    {{ $item->translate()->name }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                    <!-- Tab panes -->
                    <div class="tab-content" id="nav-tabContent">
                        @foreach($categories as $key => $item)
                            <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="nav-cat-{{ $item->id }}" role="tabpanel" aria-labelledby="nav-cat-{{ $item->id }}-tab">
                                @php
                                    $list_items = $list_product_cat[ $item->id ] ?? [];
                                @endphp
                                @if(!empty($list_items))
                                    <div class="popular_listing_slider1">
                                        <div class="row">
                                            @foreach($list_items as $item)
                                                <div class="col-sm-3">
                                                    @include('product.search.loop',['row'=>$item])
                                                </div>
                                            @endforeach
                                        </div>
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
