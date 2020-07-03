@if(!empty($row))
<div id="product-{{$row->id}}>" class="col-xs-6 col-sm-12 product">
    <div class="mf-product-detail">
        <div class="product-gallery">
            @php $galleries = explode(',',$row->gallery); @endphp
            @if(!empty($galleries))
                @foreach($galleries as $gallery_id)
                    <div class="item">
                        {!! get_image_tag($gallery_id,'full',['lazy'=>false,'alt'=>'gallery']) !!}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="summary entry-summary">
            <div class="mf-entry-product-header">
                <div class="entry-left">
                    <h2 class="product_title">
                        <a href="{{$row->getDetailUrl()}}">{{$row->title}}</a>
                    </h2>
                    <ul class="entry-meta">
                        <li class="meta-brand">
                            {{ __('Brand:') }} <a href="{{route('product.index')}}?brand[]={{$brand->id}}" class="meta-value">{{$brand->name}}</a>
                        </li>
                        <?php
                        $reviewData = $row->getScoreReview();
                        $score_total = $reviewData['score_total'];
                        ?>
                        <li class="service-review tour-review-{{$score_total}}">
                            <div class="list-star">
                                <ul class="booking-item-rating-stars">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <div class="booking-item-rating-stars-active" style="width: {{$score_total * 2 * 10 ?? 0}}%">
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
                        </li>
                        <!--<li class="meta-sku">
                            SKU: <span class="meta-value">AB123456786</span>
                        </li>-->
                    </ul>
                </div>
            </div>
            <span class="price">
                <ins><span class="Price-amount amount">{{ $row->display_price }}</span></ins>
                <del><span class="Price-amount amount">{{ $row->display_sale_price }}</span></del>
                @if(!empty($row->discount_percent))
                    <span class="sale"> {{ __(":discount off",["discount"=>$row->discount_percent]) }}</span>
                @endif
            </span>
            <div class="mf-summary-header">
                <div class="sold-by-meta">
                    <span class="sold-by-label">{{ __('Sold By:') }} </span>
                    <a href="{{ route('user.profile',['id'=>$row->create_user]) }}">{{ $row->author->getDisplayName() }}</a>
                </div>
                @php
                    $stock = ''; $in_stock = true;
                    if ($row->is_manage_stock > 0){
                        if ($row->stock_status == 'in'){
                            $stock = __(':count in stock',['count'=>$row->quantity]);
                        }
                    } else {
                        $stock = __('In Stock');
                    }
                    if ($row->stock_status == 'out'){
                        $stock = __('Out Of Stock');
                        $in_stock = false;
                    }
                @endphp
                <div class="mf-summary-meta">
                    <p class="stock {{ $in_stock ? 'in-stock' : 'out-of-stock' }}">
                        <label>{{ __('Status:') }}</label>{{ $stock }}
                    </p>
                </div>
            </div>
            <div class="woocommerce-product-details__short-description">
                {!! clean($row->short_desc) !!}
            </div>
            @if($row->stock_status == 'in')
                @include('Product::frontend.details.add-to-cart')
                <hr>
            @endif
        </div>
        <!-- .summary -->
    </div>
</div>
@endif
