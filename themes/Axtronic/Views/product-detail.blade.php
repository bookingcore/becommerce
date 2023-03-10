@extends("layouts.app")
@section('content')
     @include('global.breadcrumb')
    <div class="axtronic-page-product">
        <div class="container">
            <div class="axtronic-product-detail mb-5">
                <div class="axtronic-product_header mb-5">
                    @include('product.details.gallery')
                    <div class="axtronic-product_info">
                        <h2 class="product_title">{{$translation->title}}</h2>
                        <div class="axtronic-product_meta ">
                            @if($row->brand)
                                <p class="mb-3"><strong>{{ __("Brand:") }}</strong> <a href="{{$row->brand->getDetailUrl()}}">{{$row->brand->name}}</a></p>
                            @endif
                            @if(!empty($row->categories))
                                <p class="categories mb-0">
                                    <strong> {{__("Categories:")}}</strong>
                                    @foreach($row->categories as $k=>$category)
                                        @if($k) ,
                                        @endif
                                        <a class="c-main" href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
                                    @endforeach
                                </p>
                            @endif
                            @if($row->sku and $row->product_type != "variable")
                                <p class="mb-0"><strong>{{__("SKU: ")}}</strong> {{$row->sku}}</p>
                            @endif
                        </div>
                        @php
                            $reviewData = $row->getScoreReview();
                            $score_total = $reviewData['score_total'];
                        @endphp
                        @if(!empty($reviewData['total_review']))
                            <div class="axtronic-product_rating d-flex align-items-center">
                                @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                                <span>{{trans_choice('[0,1]( :count review)|[2,*] (:count reviews)',$reviewData['total_review'])}}</span>
                            </div>
                        @endif
                        @include('product.details.price',['show_discount_percent'=>1])
                        <div class="axtronic-product_desc mb-4">
                            <div class="desc-heading d-flex">
                                <p class="sold-by me-5 m-0">{{__('Sold By:')}}<a class="c-main" href="{{ $row->author->getStoreUrl() }}"><strong> {{$row->author->display_name}} </strong></a></p>
                                @if($row->product_type == 'simple')
                                    @php $stock_status = $row->getStockStatus() @endphp
                                    <span class="product-stock-status {{ $stock_status['in_stock'] ? 'in_stock' : 'out-of-stock'}}">{{__('Status:')}} <span><strong>{{$stock_status['stock']}}</strong></span></span>
                                @endif
                            </div>
                            <div class="axtronic-list-dot mt-3">
                                {!! clean($row->short_desc) !!}
                            </div>
                        </div>

                        @include('product.details.add-to-cart')
                        @include('product.details.specification')
                        @include('product.details.share')
                    </div>
                </div>
                <div class="axtronic-product_content">
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
