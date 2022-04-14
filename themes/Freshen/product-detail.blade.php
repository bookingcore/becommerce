@extends("layouts.app")
@section('content')
     @include('global.breadcrumb')
     <!-- Shop Single Content -->
     <section class="bc-page-product shop-single-content pb70 ovh">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6">
                     @include('product.details.gallery')
                 </div>
                 <div class="col-lg-6">
                     <div class="shop_single_product_details">
                         @if($row->product_type == 'simple')
                         <div class="shop_item_stock mb30">
                             @php $stock_status = $row->getStockStatus() @endphp
                             <span class="stock {{ $stock_status['in_stock'] ? 'in_stock' : 'out-of-stock'}}"> {{$stock_status['stock']}} </span>
                         </div>
                         @endif
                         <h3 class="title mb20">{{$translation->title}}</h3>
                         <div class="sspd_review">
                             @php
                                 $reviewData = $row->getScoreReview();
                                 $score_total = $reviewData['score_total'];
                             @endphp
                             @if(!empty($reviewData['total_review']))
                                 <div class="mb15">
                                     @include('global.rating',['percent'=>$score_total * 2 * 10 ?? 0])
                                     <span>{{trans_choice('[0,1]( :count review)|[2,*] (:count reviews)',$reviewData['total_review'])}}</span>
                                 </div>
                             @endif
                         </div>
                         <div class="sspd_price mb20">
                             @include('product.details.price',['show_discount_percent'=>1])
                         </div>
                         <div class="mb25">
                             {!! clean($row->short_desc) !!}
                         </div>
                         @include('product.details.add-to-cart')
                         <ul class="wishlist_compare">
                             <li class="list-inline-item">
                                 <div class="service-wishlist favorite_icon {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                                     <span class="flaticon-heart"></span> {{ __("Add to Wishlist") }}
                                 </div>
                             </li>
                             <li class="list-inline-item">
                                 <div href="#" class="favorite_icon bc-compare" data-id="{{$row->id}}"><span class="flaticon-shuffle"></span> {{ __("Compare") }}</div>
                             </li>
                         </ul>
                         @include('product.details.specification')
                     </div>
                 </div>
                 <div class="col-lg-12">
                     @include('product.details.tabs')
                 </div>
                 <div class="col-lg-12">
                     @include('product.details.products-related')
                 </div>
             </div>
         </div>
     </section>
@endsection
@section('footer')
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
@endsection