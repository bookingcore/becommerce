<div class="ps-product ps-product--simple loop-product">
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
    </div>
    <div class="ps-product__container">
        @if(!empty($row->brand_id))
            @php $link_search_brand = Modules\Product\Models\Product::getLinkForPageSearch(false , [ 'brand[]' => $row->brand_id] ); @endphp
            <a class="ps-product__vendor" href="{{$link_search_brand}}">{{$row->brand['name']}}</a>
        @endif
        <div class="ps-product__content" data-mh="clothing">
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
                {{ $row->display_price }} <del>{{ $row->display_sale_price }} </del>
            </p>
        </div>
    </div>
</div>