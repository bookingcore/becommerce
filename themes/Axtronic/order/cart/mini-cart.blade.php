<?php
$countCart = \Modules\Order\Helpers\CartManager::count();
?>
<div class="site-cart-side side-wrap">
    <a href="#" class="close-cart-side close-side"><span class="screen-reader-text">{{__('Close')}}</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">{{__('Shopping cart')}}</span>
    </div>
    <div class="card-side-wrap-content side-wrap-content">
        <div class="axtronic-content-scroll">
            <div class="axtronic-card-content">
                @if(!empty($countCart))
                    <ul class="nav list-items list-product-items">
                        @foreach(\Modules\Order\Helpers\CartManager::items() as $cart_item_id => $cartItem)
                            <li class="list-item product-item">
                                @if($cartItem->model)
                                    <div class="product-transition mx-2">
                                        <div class="product-img-wrap">
                                            <a href="{{$cartItem->getDetailUrl()}}">{!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'img-fluid w-75px','lazy'=>false])!!} </a>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <h2 class="product__title">
                                            <a href="{{$cartItem->getDetailUrl()}}">{{$cartItem->model->title}}</a>
                                        </h2>
                                        <div class="price">
                                            <div class="axtronic-product-price">
                                                <p class="price has-sale m-0">
                                                @if(is_vendor_enable() and !empty($cartItem->author))
                                                    <small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small>
                                                @endif
                                                <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="remove remove_button axtronic_delete_cart_item" data-id="{{$cartItem->id}}">×</a>
                                @else
                                    <div class="product-transition mx-2">
                                        <div class="product-img-wrap">
                                            <a href="#"><img src="" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <h2 class="product__title">
                                            <a href="#">{{$cartItem->name}}</a>
                                        </h2>
                                        @if(!empty($cartItem->author))
                                            <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                                        @endif
                                        <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                                    </div>
                                    <a href="" class="remove remove_button axtronic_delete_cart_item" data-id="{{$cartItem->id}}">×</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    {{--Danh sách wishlist trống--}}
                    <div class="axtronic-content-mid-notice">
                        {{__('There are no products on the cart!')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="axtronic-card-bottom">
            <p class=" card-bottom-total">
                <strong>{{__('Subtotal')}}:</strong> <span class="amount"><bdi>{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</bdi></span>
            </p>
            <p class="card-bottom-button">
                <a class="button wc-forward" href="{{route('cart')}}">{{__('View Cart')}}</a>
                <a class="button checkout wc-forward" href="{{route('checkout')}}">{{__("Checkout")}}</a>
            </p>
        </div>
    </div>
</div>
<div class="cart-side-overlay side-overlay"></div>
