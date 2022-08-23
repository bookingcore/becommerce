@extends("layouts.app")
@section('content')
    <nav aria-label="breadcrumb" class="demus-breadcrumb-news">
        <div class="container-fluid">
            @if(!empty($breadcrumbs))
                <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="{{url('/')}}"><span itemprop="name">{{__("Home")}}</span></a></li>
                    @foreach($breadcrumbs as $item)
                        <?php if(empty($item['name'])) ?>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            @if(!empty($item['url']))
                                <a itemprop="item" href="{{$item['url']}}"><span itemprop="name">{{$item['name']}}</span></a>
                            @else
                                <span itemprop="name">{{$item['name']}}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            @endif
        </div>
    </nav>
    <div class="bc-page-product">
        <div class="container">
            <div class="bc-product-detail mb-5">
                <div class="bc-product_header mb-5">
                    @include('product.details.gallery')
                    <div class="bc-product_info">
                        <h1 class="fs-24 mb-2">{{$translation->title}}</h1>
                            <div class="bc-product_meta mb-4 d-flex">
                                @if($row->brand)
                                <p>{{ __("Brand:") }} <a href="{{$row->brand->getDetailUrl()}}">{{$row->brand->name}}</a></p>
                                @endif
                                @php
                                    $reviewData = $row->getScoreReview();
                                    $score_total = $reviewData['score_total'];
                                @endphp
                                @if(!empty($reviewData['total_review']))
                                    <div class="bc-product_rating">
                                        @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                                        <span>{{trans_choice('[0,1]( :count review)|[2,*] (:count reviews)',$reviewData['total_review'])}}</span>
                                    </div>
                                @endif
                            </div>
                        @include('product.details.price',['show_discount_percent'=>1])
                        <div class="bc-product_desc mb-4">
                            <div class="desc-heading d-flex">
                                <p class="sold-by me-5 m-0">{{__('Sold By:')}}<a class="c-main" href="{{ $row->author->getStoreUrl() }}"><strong> {{$row->author->display_name}} </strong></a></p>
                                @if($row->product_type == 'simple')
                                    @php $stock_status = $row->getStockStatus() @endphp
                                    <span class="product-stock-status {{ $stock_status['in_stock'] ? 'in_stock' : 'out-of-stock'}}">{{__('Status:')}} <span><strong>{{$stock_status['stock']}}</strong></span></span>
                                @endif
                            </div>
                            <div class="bc-list-dot mt-3">
                                {!! clean($row->short_desc) !!}
                            </div>
                        </div>

                        @include('product.details.add-to-cart')
                        @include('product.details.specification')
                        @include('product.details.share')
                    </div>
                </div>
                <div class="bc-product_content">
                    @include('product.details.tabs')
                    @include('product.details.up-sells')
                    @include('product.details.products-related')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        jQuery(function ($) {
            $(window).on("load", function () {
                var urlHash = window.location.href.split("#")[1];
                if (urlHash &&  $('.' + urlHash).length ){
                    new bootstrap.Tab(document.querySelector('#tab-review')).show();
                    var offset_other = 70;
                    $('html,body').animate({
                        scrollTop: $('.' + urlHash).offset().top - offset_other
                    }, 1000);
                }
            });
        })
    </script>
@endpush
