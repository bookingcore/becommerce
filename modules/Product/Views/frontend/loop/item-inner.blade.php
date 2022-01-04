<div class="ps-product ps-product--inner loop-product">
    <div class="ps-product__thumbnail">
        @if($image = get_image_tag($row['image_id']))
            <a href="{{ $row->getDetailUrl() }}">
                <img src="{{get_file_url($row['image_id'],'thumb')}}" alt="{{$row->title}}" />
            </a>
        @endif
        @if($row->stock_status == "in")
            @if(!empty($row->discount_percent))
                <div class="ps-product__badge">-{{$row->discount_percent}}</div>
            @endif
        @else
            <span class="ps-product__badge out-stock">{{__('Out Of Stock')}}</span>
        @endif
        <ul class="ps-product__actions">
            @php $in_stock = $row->stock_status == 'in' @endphp
            @if($row->product_type == 'simple')
                <li>
                    <a href="{{ $in_stock ? '#' : $row->getDetailUrl() }}" class="{{ $in_stock ? 'bc_add_to_cart' : '' }}" data-product='{"id":{{$row->id}},"type":"simple"}' data-toggle="tooltip" data-placement="top" title="{{ $in_stock ? __("Add to cart") : __("Read more") }}">
                        <i class="icon-bag2"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $row->getDetailUrl() }}" class="bc_add_to_cart" data-toggle="tooltip" title="{{ __('Select options') }}">
                        <i class="icon-bag2"></i>
                    </a>
                </li>
            @endif
            <li>
                <a href="#" class="bc-product-quick-view" data-placement="top" title="{{ __("Quick View") }}"  data-toggle="tooltip" data-product={"id":{{$row->id}},"type":"{{$row->type}}"}>
                    <i class="icon-eye"></i>
                </a>
            </li>
            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
            <li>
                <a href="#" class="compare-button mf-compare-button {{ in_array($row->id, list_compare_id()) ? 'browse' : '' }}" data-toggle="tooltip" title="{{ in_array($row->id, list_compare_id()) ? __('Browse Compare') : __('Compare') }}" data-id="{{$row->id}}">
                    <i class="icon-chart-bars"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="ps-product__container">
        @if(!empty($row->brand_id))
            @php $link_search_brand = Modules\Product\Models\Product::getLinkForPageSearch(false , [ 'brand[]' => $row->brand_id] ); @endphp
            <a class="ps-product__vendor" href="{{$link_search_brand}}">{{$row->brand['name']}}</a>
        @endif
        <div class="ps-product__content">
            <a class="ps-product__title" href="{{ $row->getDetailUrl() }}">
                {{$row->title}}
            </a>
            <div class="ps-product__rating">
                @php
                    $reviewData = (!empty($row)) ? $row->getScoreReview() : [];
                    $score_total = $reviewData['score_total'];
                @endphp
                <div class="service-review">
                    <div class="list-star">
                        <ul class="item-rating-stars">
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                        <div class="item-rating-stars-active"
                             style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                            <ul class="item-rating-stars">
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
            </div>
            <p class="ps-product__price @if(!empty($row->discount_percent)) sale @endif">
                {{ $row->display_price }} <del>{{ $row->display_origin_price }} </del>
            </p>
        </div>
    </div>
</div>