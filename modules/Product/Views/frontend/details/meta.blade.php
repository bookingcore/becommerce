<div class="product-detail-meta">
    <h1 class="product-name">{{$translation->title}}</h1>
        <div class="brand-review">
            @if($row->brand)
                <div class="product-brand d-inline-block">{{__("Brand:")}} <a href="{{$row->brand->getDetailUrl()}}" target="_blank">{{$row->brand->name}}</a></div>
            @endif
            <?php
            $reviewData = $row->review_data;
            $score_total = $reviewData['score_total'];
            ?>
            <div class="service-review product-review-{{$score_total}} d-inline-block">
                <div class="list-star">
                    <ul class="booking-item-rating-stars">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                    <div class="booking-item-rating-stars-active" style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
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
                {{trans_choice('[0,1]( :count review)|[2,*] (:count reviews)',$reviewData['total_review'])}}
                </span>
            </div>
        </div>
    <hr>
    @include('Product::frontend.details.price')
    <div class="product-summary-header">
        <span class="sold-by">{{__('Sold By:')}} <a href="{{route('user.profile',['id'=>$row->create_user])}}" target="_blank">{{$row->author->getDisplayName()}}</a></span>
        <span class="product-stock-status {{$row->stock_status_code}}">{{__('Status:')}} <span>{{$row->stock_status_text}}</span></span>
    </div>
    <div class="product-short-desc">
        {!! clean($row->short_desc) !!}
    </div>
    <hr>
    @include('Product::frontend.details.add-to-cart')
    <hr>
    <div class="product-other">
        <div class="other-item item-report">
            <span class="val"><a href="#report">{{__('Report Abuse')}}</a></span>
        </div>
        @if($row->sku)
        <div class="other-item item-sku">
            <span class="label">{{__("SKU: ")}}</span>
            <span class="val">{{$row->sku}}</span>
        </div>
        @endif
        @if(!empty($row->categories))
        <div class="other-item item-categories">
            <span class="label">{{__("Categories: ")}}</span>
            <span class="val">
                @foreach($row->categories as $k=>$category)
                    @if($k) ,
                    @endif
                    <a href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
                @endforeach
            </span>
        </div>
        @endif

        @if(!empty($row->tags))
        <div class="other-item item-tags">
            <span class="label">{{__("Tags: ")}}</span>
            <span class="val">
                @foreach($row->tags as $k=>$category)
                    @if($k) ,
                    @endif
                    <a href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
                @endforeach
            </span>
        </div>
        @endif
        @include('Product::frontend.details.share')
    </div>
</div>