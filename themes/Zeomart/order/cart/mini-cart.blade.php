<?php
$countCart = \Modules\Order\Helpers\CartManager::count();
?>
<div class="bc-cart ml-5 zm-dropdown relative">
    <a href="#" class="flex items-center cart_btn zm-dropdown-toggle">
        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0.833333C0 0.373096 0.373096 0 0.833333 0H4.16667C4.56386 0 4.90584 0.280321 4.98379 0.669786L5.68369 4.16667H19.1667C19.415 4.16667 19.6504 4.27744 19.8088 4.4688C19.9671 4.66015 20.0318 4.91215 19.9853 5.15611L18.6508 12.154C18.5364 12.7295 18.2233 13.2465 17.7663 13.6144C17.3115 13.9805 16.743 14.1758 16.1595 14.1667H8.07387C7.49032 14.1758 6.92183 13.9805 6.46707 13.6144C6.01021 13.2466 5.6972 12.7299 5.58278 12.1547C5.58273 12.1545 5.58283 12.1549 5.58278 12.1547L4.19066 5.19933C4.18501 5.17632 4.18032 5.15294 4.17663 5.12923L3.4836 1.66667H0.833333C0.373096 1.66667 0 1.29357 0 0.833333H0ZM6.01728 5.83333L7.21737 11.8293C7.25547 12.0212 7.35983 12.1935 7.51218 12.3161C7.66453 12.4387 7.85516 12.5039 8.0507 12.5002L8.06667 12.5H16.1667L16.1827 12.5002C16.3782 12.5039 16.5688 12.4387 16.7212 12.3161C16.8728 12.194 16.9769 12.0227 17.0154 11.832L18.1594 5.83333H6.01728Z" fill="#041E42"/>
        </svg>
        <span class="hidden absolute top-0 start-100 translate-middle badge rounded-pill bg-danger number">
            {{\Modules\Order\Helpers\CartManager::count()}}
        </span>
        <span class="text pl-2 text-sm">{{__("Cart")}}</span>
    </a>
    <ul class="zm-dropdown-menu bc-mini-cart-dropdown bc-cart-items hidden origin-top-right absolute right-0 mt-4 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none min-h-[200px]">
        @if(!empty($countCart))
            @foreach(\Modules\Order\Helpers\CartManager::items() as $cart_item_id => $cartItem)
                <li class="list_content">
                    @if($cartItem->model)
                        <a href="{{$cartItem->getDetailUrl()}}">
                            {!! get_image_tag($cartItem->model->image_id,'thumb',['class'=>'float-start','lazy'=>false])!!}
                            <p>{{$cartItem->model->title}}</p>
                            @if(is_vendor_enable() and !empty($cartItem->author))
                                <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                            @endif
                            <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                            <span class="close_icon float-end bc_delete_cart_item" data-id="{{$cartItem->id}}">
                                <i class="fa fa-plus"></i>
                            </span>
                        </a>
                    @else
                        <li class="list_content">
                            <a href="#">
                                <img class="float-start" src="#" alt="50x50">
                                <p>{{$cartItem->title}}</p>
                                @if(!empty($cartItem->author))
                                    <div><small>{{__('Sold By:')}}<strong> {{$cartItem->author}}</strong></small></div>
                                @endif
                                <small> {{__(':qty x :price',['qty'=>$cartItem->qty,'price'=>format_money($cartItem->price)])}}</small>
                                <span class="close_icon float-end bc_delete_cart_item" data-id="{{$cartItem->id}}">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </li>
                    @endif
                </li>
            @endforeach
            <li class="list_content bc-cart-footer">
                <h5>Subtotal: <span class="text-thm fw400 float-end">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span></h5>
                <a href="{{route('cart')}}" class="btn btn-thm cart_btns">{{ __("VIEW CART") }}</a>
                <a href="{{route('checkout')}}" class="btn btn-thm2 checkout_btns">{{ __("CHECKOUT") }}</a>
            </li>
        @else
            <li class="min-h-[200px] flex justify-center items-center">
                <div class="text-center font-weight-bold">{{__("Your cart is empty")}}</div>
            </li>
        @endif
    </ul>
</div>
