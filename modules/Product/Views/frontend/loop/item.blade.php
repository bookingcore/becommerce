@php
    $link_search_brand = Modules\Product\Models\Product::getLinkForPageSearch(false , [ 'brand[]' => $row->brand_id] );
    @endphp
<div class="product-inner">
    <div class="mf-product-thumbnail">
        <a href="{{ $row->getDetailUrl() }}">
            @if($image = get_image_tag($row['image_id']))
                <img src="{{get_file_url($row['image_id'],'thumb')}}" alt="{{$row['title'] ?? ''}}">
            @endif
            @if(!empty($row->discount_percent))
                <span class="ribbons">
                    <span class="onsale ribbon">
                        <span class="sep">-</span>{{$row->discount_percent}}
                    </span>
                </span>
            @endif
        </a>

        <div class="footer-button">
            <a href="#">
                <i class="p-icon icon-bag2" data-rel="tooltip" title="{{__('Add to cart')}}"></i>
                <span class="add-to-cart-text">{{__('Add to cart')}}</span>
            </a>
            <a href="#" class="mf-product-quick-view">
                <i class="p-icon icon-eye" title="{{__('Quick View')}}" data-rel="tooltip"></i>
            </a>
            <!-- ADD TO WISHLIST -->
            <div class="yith-wcwl-add-to-wishlist service-wishlist {{ (in_array($row->id, $wishlist)) ? 'active' : '' }}" data-id="{{ $row->id }}" data-type="{{ $row->type }}" title="{{(in_array($row->id, $wishlist)) ? __('Browse to Wishlist') : __('Add to Wishlist')}}">
                <div class="yith-wcwl-add-button">
                    <a href="{{route('user.wishList.index')}}" class="wishlist_link" data-rel="tooltip">
                        <i class="yith-wcwl-icon fa fa-heart-o"></i>
                    </a>
                </div>
            </div>
            <!-- COUNT TEXT -->
            <div class="compare-button mf-compare-button">
                <a href="#" class="compare" title="{{__('Compare')}}">{{__('Compare')}}</a>
            </div>
        </div>
    </div>
    <div class="mf-product-details">
        <div class="mf-product-content">
            <div class="mf-vendor-name">
                <div class="sold-by-meta">
                    <span class="sold-by-label">{{__('Brand: ')}}</span>
                    <a href="{{$link_search_brand}}">{{$row->brand->name ?? ''}}</a>
                </div>
            </div>

            <h2><a href="{{ $row->getDetailUrl() }}">{{__($row['title']) ?? ''}}</a></h2>

            <?php
            $reviewData = (!empty($row)) ? $row->getScoreReview() : [];
            $score_total = $reviewData['score_total'];
            ?>
            <div class="service-review tour-review-{{$score_total}}">
                <div class="list-star">
                    <ul class="booking-item-rating-stars">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                    <div class="booking-item-rating-stars-active"
                         style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                        <ul class="booking-item-rating-stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <span class="review">
                    @if($reviewData['total_review'] > 1)
                        {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                        @else
                        {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                        @endif
                </span>
            </div>


            <div class="sold-by-meta">
                <span class="sold-by-label">{{__('Brand: ')}}</span>
                <a href="{{$link_search_brand}}">{{$row->brand->name ?? ''}}</a></div>
        </div>

        <div class="mf-product-price-box">
            <span class="price">
                <ins><span
                        class="woocommerce-Price-amount amount">{{ $row->display_price }}</span></ins>
                <del><span
                        class="woocommerce-Price-amount amount">{{ $row->display_sale_price }}</span></del>
                @if(!empty($row->discount_percent))
                    <span
                        class="sale"> {{ __(":discount off",["discount"=>$row->discount_percent]) }}</span>
                @endif
            </span>
        </div>
    </div>
</div>
