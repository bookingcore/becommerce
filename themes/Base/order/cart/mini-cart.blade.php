<?php
$countCart = \Modules\Order\Helpers\CartManager::count();
?>
<div class="dropdown dropstart ">
    <a  class="position-relative" data-bs-toggle="dropdown">
        <i class="fa fa-shopping-cart fa-2x c-main"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger bc-mini-cart-count-item">
            {{\Modules\Order\Helpers\CartManager::count()}}
            <span class="visually-hidden">{{__("Your cart")}}</span>
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="bc-mini-cart-dropdown px-3 py-2">
            @if(!empty($countCart))
                <div class="bc-cart-items">
                    @foreach(\Modules\Order\Helpers\CartManager::items() as $cart_item_id => $cartItem)
                        <div class="bc-product-cart-mobile d-flex">
                            @if($cartItem->model)
                                <div class="bc-product-thumbnail">
                                    <a href="{{$cartItem->model->getDetailUrl()}}">{!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'img-fluid w-75px','lazy'=>false])!!} </a></div>
                                <div class="bc-product-content">
                                    <a href="{{$cartItem->model->getDetailUrl()}}">{{$cartItem->model->title}}</a>
                                    @if(!empty($cartItem->author))
                                        <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                                    @endif
                                    <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                                </div>
                                <div class="bc-product-action">
                                    <a class="bc-product-remove bc_delete_cart_item" data-id="{{$cartItem->id}}" href="#"><i class="fa fa-close text-danger"></i></a>
                                </div>
                            @else
                                <div class="bc-product-thumbnail">
                                    <a href="#"><img src="" alt=""></a></div>
                                <div class="bc-product-content">
                                    <a href="#">{{$cartItem->name}}</a>
                                    @if(!empty($cartItem->author))
                                        <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                                    @endif
                                    <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                                </div>
                                <div class="bc-product-action">
                                    <a class="bc-product-remove bc_delete_cart_item" data-id="{{$cartItem->id}}" href="#"><i class="fa fa-close text-danger"></i></a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="bc-cart-footer border-top pt-3 mt-3">
                    <div class="d-flex justify-content-between">
                        <h5> {{__('Subtotal')}}: </h5>
                        <strong>{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a class="btn btn-sm btn-primary" href="{{route('cart')}}">{{__('View Cart')}}</a>
                        <a class="btn btn-sm btn-primary" href="{{route('checkout')}}">{{__("Checkout")}}</a>
                    </div>
                </div>
            @else
                <div class="bc-cart-items">
                    <p class="text-center font-weight-bold">{{__("Your cart is empty")}}</p>
                </div>
            @endif
        </div>
    </div>
</div>
