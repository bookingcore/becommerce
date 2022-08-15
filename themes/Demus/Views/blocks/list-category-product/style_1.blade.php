<section class="featured-product pt0">
    <div class="container">

        <div class=" d-flex justify-content-between align-items-end flex-wrap mb-4 pb-3 pb-lg-4">
            @if(!empty($title))
                <h2 class="heading-title m-0">{!! clean($title) !!}</h2>
            @endif
            @if(count($categories) > 1 && !empty($categories))
                <div class="nav nav-tabs" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{__('All')}}</button>
                    @foreach($categories as $item)
                        <button class="nav-link" id="nav-{{ $item->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-cat-{{ $item->id }}" role="tab" aria-controls="nav-cat-{{ $item->id }}" aria-selected="false">
                            {{ $item->translate()->name }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="tab-content" id="nav-tabContent">
            @if(!empty($rows) && count($categories) > 1)
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row g-3 g-md-4 g-xl-5 align-items-stretch">
                        <div class="col-12 col-lg-6 tabs-collecitons__image">
                            <figure>
                                <img src="{{ get_file_url( $image ?? false,'full') }}" alt="{{__("All")}}">
                                <figcaption>
                                    <h5><a href="/product" class=" btn-link">{{__("All")}}</a></h5>
                                    <p>{{ count($rows) }} {{__("products")}}</p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-12 col-lg-6 tabs-collecitons__wrapper">
                            <div class="row g-3 g-md-4 g-xl-5 row-cols-2 row-cols-ms-1 row-cols-md-2 row-cols-lg-2">
                                @foreach($rows as $row)
                                    <div class="col">
                                        @include('product.search.loop')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach($categories as $item)
                <div class="tab-pane fade {{count($categories) < 2 ? 'show active' : ''}} " id="nav-cat-{{ $item->id }}" role="tabpanel" aria-labelledby="nav-cat-{{ $item->id }}-tab">
                    @php $list_items = $list_product_cat[ $item->id ] ?? [] @endphp
                    <div class="row g-3 g-md-4 g-xl-5">
                        <div class="col-12 col-lg-6 tabs-collecitons__image">
                            <figure>
                                <img src="{{  get_file_url($item->image_id ?? "", 'full') }}" alt=" {{ $item->translate()->name }}">
                                <figcaption>
                                    <h5><a href="{{$item->getDetailUrl()}}" class=" btn-link"> {{ $item->translate()->name }}</a></h5>
                                    <p>{{ count($list_items) }} {{__("products")}}</p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-12 col-lg-6 tabs-collecitons__wrapper">
                            <div class="swiper swiper-cate">
                                <div class="swiper-wrapper">
                                    @if(!empty($list_items))
                                        @foreach($list_items as $row)
                                            <div class="swiper-slide">
                                                @include('product.search.loop',['row'=>$row])
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
