<section class="featured-product pt0">
    <div class="container">
        @if(!empty($title))
            <div class=" d-flex justify-content-center align-items-center flex-column mb-4 pb-3 pb-lg-4">
                <h2 class="heading-title mb-2">{!! clean($title) !!}</h2>
                <p class="sub-heading">{!! clean($sub_title) !!}</p>
                @if(!empty($rows) && count($categories) > 1 && !empty($categories))
                    <div class="nav nav-tabs" role="tablist">
                        @foreach($categories as $key => $item)
                            <button class="nav-link @if($key == 0) active @endif" id="nav-{{ $item->id }}" data-bs-toggle="tab" data-bs-target="#nav-cat-{{ $item->id }}" role="tab" aria-controls="nav-{{ $item->id }}" aria-selected="false">
                                <span class="flaticon-harvest mr5"></span> {{ $item->translate()->name }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
        <div class="tab-content" id="nav-tabContent">
            @foreach($categories as $key => $item)
                <div class="tab-pane fade @if($key == 0) show active @endif " id="nav-cat-{{ $item->id }}" role="tabpanel" aria-labelledby="nav-cat-{{ $item->id }}-tab">
                    @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp

                    <div class=" tabs-collecitons__wrapper">
                        <div class="row g-3 g-md-4 g-xl-5 row-cols-2 row-cols-ms-1 row-cols-md-3 row-cols-lg-3">
                            @if(!empty($list_items))
                                @foreach($list_items as $row)
                                    <div class="col">
                                        @include('product.search.loop',['row'=>$row])
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
