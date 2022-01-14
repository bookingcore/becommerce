@extends("layouts.app")
@section('content')
    @include('global.bc')
    <div class="bc-page-product">
        <div class="container">
            <div class="bc-product-detail mb-5">
                <div class="bc-product_header">
                    @include('product.details.gallery')
                    <div class="bc-product_info">
                        <h1>{{$translation->title}}</h1>
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
                                <p class="sold-by me-5 m-0">{{__('Sold By:')}}<a href="{{route('user.profile',['id'=>$row->create_user])}}"><strong> {{$row->author->getDisplayName()}} </strong></a></p>
                                @if($row->product_type == 'simple')
                                    @php $stock_status = $row->getStockStatus() @endphp
                                    <span class="product-stock-status {{ $stock_status['in_stock'] ? 'in_stock' : 'out-of-stock'}}">{{__('Status:')}} <span><strong>{{$stock_status['stock']}}</strong></span></span>
                                @endif
                            </div>
                            <div class="bc-list-dot mt-3">
                                {!! clean($row->short_desc) !!}
                            </div>
                        </div>
                        @include('product.details.color')
                        @include('product.details.add-to-cart')
                        <div class="bc-product__specification">
                            @if($row->sku)
                                <p><strong>{{__("SKU: ")}}</strong> {{$row->sku}}</p>
                            @endif
                            @if(!empty($row->categories))
                                <p class="categories">
                                    <strong> {{__("Categories:")}}</strong>
                                    @foreach($row->categories as $k=>$category)
                                        @if($k) ,
                                        @endif
                                        <a href="{{$category->getDetailUrl()}}">{{$category->name}}</a>
                                    @endforeach
                                </p>
                            @endif
                            @if(!empty($row->tags))
                                <p class="tags">
                                    <strong> {{ __("Tags") }}</strong>
                                    @foreach($row->tags as $k=>$category)
                                        @if($k) ,
                                        @endif
                                        <a href="{{ route('product.index')."?tag=$category->slug" }}">{{$category->name}}</a>
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        @include('product.details.share')
                    </div>
                </div>
                @include('product.details.tabs')
            </div>
            {{--<div class="bc-section--default">
                <div class="bc-section__header">
                    <h3>Related products</h3>
                </div>
                <div class="bc-section__content">
                    <div class="bc-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/11.jpg" alt="" /></a>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Robert's Store</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price">$13.43</p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                    <p class="bc-product__price">$13.43</p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/12.jpg" alt="" /></a>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Global Office</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price">$75.44</p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                    <p class="bc-product__price">$75.44</p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/13.jpg" alt="" /></a>
                                <div class="bc-product__badge">-7%</div>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Young Shop</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p class="bc-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/14.jpg" alt="" /></a>
                                <div class="bc-product__badge">-7%</div>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Global Office</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                    <p class="bc-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/15.jpg" alt="" /></a>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Young Shop</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price sale">$332.38</p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                    <p class="bc-product__price sale">$332.38</p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/16.jpg" alt="" /></a>
                                <div class="bc-product__badge">-7%</div>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Young Shop</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price sale">$1200.00 <del>$1362.99 </del></p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                    <p class="bc-product__price sale">$1200.00 <del>$1362.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/17.jpg" alt="" /></a>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Robert's Store</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price">$599.00</p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <p class="bc-product__price">$599.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/18.jpg" alt="" /></a>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Robert's Store</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price">$233.28</p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <p class="bc-product__price">$233.28</p>
                                </div>
                            </div>
                        </div>
                        <div class="bc-product">
                            <div class="bc-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/19.jpg" alt="" /></a>
                                <ul class="bc-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul>
                            </div>
                            <div class="bc-product__container"><a class="bc-product__vendor" href="#">Robert's Store</a>
                                <div class="bc-product__content"><a class="bc-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <div class="bc-product__rating">
                                        <select class="bc-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="bc-product__price">$233.28</p>
                                </div>
                                <div class="bc-product__content hover"><a class="bc-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <p class="bc-product__price">$233.28</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
@endsection
