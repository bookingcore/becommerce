<div class="our-shops pb0 pt30 bgc-f5">
    <div class="container">
        <div class="fruit_custom_widget">
            <div class="main-title">
                <div class="">
                    @if(!empty($title))
                        <div class="box-heading-title text-center ">
                            <h2 class="heading-title ">{!! clean($title) !!}</h2>
                            <p class="sub-heading">{!! clean($sub_title) !!}</p>
                        </div>
                    @endif
                    <div class="popular_listing_sliders">
                        <!-- Nav tabs -->
                        @if(!empty($categories))
                            <div class="nav nav-tabs justify-content-end" role="tablist">
                                @foreach($categories as $key => $item)
                                    <button class="nav-link @if($key == 0) active @endif" id="nav-{{ $item->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $item->id }}" role="tab" aria-controls="nav-{{ $item->id }}" aria-selected="true">
                                        <span class="flaticon-harvest mr5"></span> {{ $item->translate()->name }}
                                    </button>
                                @endforeach
                            </div>
                        @endif
                        <!-- Tab panes -->
                    </div>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_listing_sliders home4_style row pb30">
                        <div class="tab-content col-lg-12" id="nav-tabContent">
                            @foreach($categories as $key => $item)
                                <div class="tab-pane fade @if($key == 0) active show @endif" id="nav-{{ $item->id }}" role="tabpanel" aria-labelledby="nav-{{ $item->id }}-tab">
                                    @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp
                                    <div class="row g-3 g-md-4 g-xl-5 row-cols-4 row-cols-ms-1 row-cols-md-3 row-cols-lg-4">
                                        @if(!empty($list_items))
                                            @foreach($list_items as $row)
                                                <div class="col">
                                                    @include('product.search.loop',['row'=>$row])
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
