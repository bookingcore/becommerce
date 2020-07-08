<li class="product">
    <div class="product-inner">
        <div class="mf-product-thumbnail">
            <a href="{{$row->getDetailUrl()}}">
                {!! get_image_tag($row->image_id,'thumb',['lazy'=>true,'alt'=>$row->title]) !!}
            </a>
            <div class="footer-button">
                @php $in_stock = $row->stock_status == 'in' @endphp
                @if($row->product_type == 'simple')
                    <a href="{{ $in_stock ? '#' : $row->getDetailUrl() }}" class="add_to_cart {{ $in_stock ? 'bravo_add_to_cart' : '' }}" data-product='{"id":{{$row->id}},"type":"simple"}'>
                        <i class="p-icon icon-bag2" data-toggle="tooltip" title="{{ $in_stock ? __("Add to cart") : __("Read more") }}"></i>
                    </a>
                @else
                    <a href="{{ $row->getDetailUrl() }}" class="add_to_cart">
                        <i class="p-icon icon-bag2" data-toggle="tooltip" title="{{ __('Select options') }}"></i>
                    </a>
                @endif

                <a href="#" class="mf-product-quick-view" data-toggle="tooltip" title="{{__('Quick View')}}" data-product={"id":{{$row->id}},"type":"{{$row->type}}"}>
                    <i class="p-icon icon-eye"></i>
                </a>
                @php $hasWishList = in_array($row->id, wishlist()); @endphp
                <div class="yith-wcwl-add-to-wishlist service-wishlist {{ $hasWishList ? 'active' : '' }}" data-id="{{ $row->id }}" data-type="{{ $row->type }}" data-toggle="tooltip" title="{{ $hasWishList ? __('Browse to Wishlist') : __('Add to Wishlist')}}">
                    <div class="yith-wcwl-add-button">
                        <a href="{{route('user.wishList.index')}}" class="wishlist_link">
                            <i class="yith-wcwl-icon fa fa-heart-o"></i>
                        </a>
                    </div>
                </div>
                <div class="compare-button mf-compare-button" data-toggle="tooltip" title="{{__('Compare')}}" data-id="{{$row->id}}">
                    <a href="#" class="compare">{{__('Compare')}}</a>
                </div>
            </div>

            <span class="ribbons">
            @if($row->stock_status == "in")
                @if(!empty($row->discount_percent))
                    <span class="onsale ribbon">
                        <span class="sep">-</span>{{$row->discount_percent}}
                    </span>
                @endif
            @else
                <span class="out-of-stock ribbon">{{__('Out Of Stock')}}</span>
            @endif
            </span>

        </div>

        <div class="mf-vendor-name">
            <div class="sold-by-meta">
                <span class="sold-by-label">{{__('Brand: ')}}</span>
                @php
                    $link_search_brand = Modules\Product\Models\Product::getLinkForPageSearch(false , [ 'brand[]' => $row->brand_id] );
                @endphp
                <a href="{{$link_search_brand}}">{{$row->brand->name}}</a>
            </div>
        </div>
        <div class="product-price">
            @include('Product::frontend.details.price')
        </div>

        <h2>
            <a href="{{$row->getDetailUrl()}}">{{$row->title ?? ''}}</a>
        </h2>
        @if($brand = $row->brand->name ?? "")
            <div class="sold-by-meta">
                <span class="sold-by-label">{{__('Brand: ')}}</span>
                <span>{{$brand}}</span>
            </div>
        @endif

        <?php
        $reviewData = $row->getScoreReview();
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
                <span class="review_number">{{ $reviewData['total_review'] }}</span>
                <span class="review_text">{{ $reviewData['total_review'] > 1 ? __('Reviews') : __('Review') }}</span>
            </span>
        </div>
    </div>
</li>
