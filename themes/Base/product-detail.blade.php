@extends("layouts.app")
@section('content')
     @include('global.breadcrumb')
    <div class="bc-page-product">
        <div class="container">
            <div class="bc-product-detail mb-5">
                <div class="bc-product_header mb-5">
                    @include('product.details.gallery')
                    <div class="bc-product_info">
                        <h1 class="fs-24 mb-2">{{$translation->title}}</h1>
                        @if($row->brand)
                            <div class="bc-product_meta mb-4 d-flex">
                                <p>{{ __("Brand:") }}<a href="{{$row->brand->getDetailUrl()}}">{{$row->brand->name}}</a></p>
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
                        @endif
                        @include('product.details.price')
                        <div class="bc-product_desc mb-4">
                            <div class="desc-heading d-flex">
                                <p class="sold-by me-5 m-0">{{__('Sold By:')}}<a class="c-main" href="{{route('user.frond.profile',['id'=>$row->create_user])}}"><strong> {{$row->author->getDisplayName()}} </strong></a></p>
                                @if($row->product_type == 'simple')
                                    @php $stock_status = $row->getStockStatus() @endphp
                                    <span class="product-stock-status {{ $stock_status['in_stock'] ? 'in_stock' : 'out-of-stock'}}">{{__('Status:')}} <span><strong>{{$stock_status['stock']}}</strong></span></span>
                                @endif
                            </div>
                            <div class="bc-list-dot mt-3">
                                {!! clean($row->short_desc) !!}
                            </div>
                        </div>
                        @if($row->product_type == 'variable')
                            @include('product.details.variations')
                        @endif
                        @include('product.details.add-to-cart')
                        @include('product.details.specification')
                        @include('product.details.share')
                    </div>
                </div>
                <div class="bc-product_content">
                    @include('product.details.tabs')
                </div>
            </div>
        </div>
    </div>
@endsection
