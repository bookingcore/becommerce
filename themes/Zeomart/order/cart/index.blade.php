@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <h1 class="text-xl font-bold text-black text-center my-10">{{__("Shopping Cart")}}</h1>

    <div class="my-3">
        @include('global.message')
    </div>

    <div class="grid xl:grid-cols-12 gap-4">
        <div class="col-span-8">
            @if(\Modules\Order\Helpers\CartManager::count())
                <div class="shopping_cart_table">
                    <form action="{{route('cart.update_cart_item')}}" method="post">
                        @csrf
                        <table class="mx-auto  w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                            <thead class="bg-slate-100">
                            <tr>
                                <th class=" py-3">{{__("PRODUCT")}}</th>
                                <th class=" py-3">{{__('PRICE')}}</th>
                                <th class=" py-3">{{__('QUANTITY')}}</th>
                                <th class=" py-3">{{__('SUBTOTAL')}}</th>
                                <th  class=" py-3">{{__('REMOVE')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table_body">
                            @foreach(\Modules\Order\Helpers\CartManager::items() as $cartItem)
                                <tr>
                                    <th>
                                        <ul class="cart_list flex">
                                            @if(!empty($cartItem->model->image_id))
                                                <li class="list-inline-item mr-2"><a href="{{$cartItem->getDetailUrl()}}">{!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>'img-fluid w-24'])!!}</a></li>
                                            @endif
                                            <li class="list-inline-item">
                                                <a class="cart_title" href="{{$cartItem->getDetailUrl()}}">{{$cartItem->title}}</a>
                                                @if($variation = $cartItem->variation and $terms = $variation->terms())
                                                    <ul class="mb-2">
                                                        @foreach($terms as $term)
                                                            <li><span>{{$term->attribute->name}}:</span> {{$term->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @if(is_vendor_enable() and !empty($cartItem->author))
                                                    <p class="mb-0 small">{{__('Sold By:')}} {{$cartItem->author}}</p>
                                                @endif
                                            </li>
                                        </ul>
                                    </th>
                                    <td>{{format_money($cartItem->price)}}</td>
                                    <td><input class="cart_count text-center" name="cart_item[{{$cartItem->id}}][qty]" value="{{$cartItem->qty}}" type="number"></td>
                                    <td class="text-thm">{{format_money($cartItem->sub_total)}}</td>
                                    <td><a class="close_img bc_delete_cart_item" data-bs-toggle="tooltip" data-id="{{$cartItem->id}}" data-remove="tr" title="{{__('Remove')}}" href="#"><img src="{{theme_url("Freshen/images/shop/close.png")}}" alt=""></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="checkout_form mt-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout_coupon section-coupon-form">
                                        <div class="df db-520 justify-content-between">
                                            <input name="coupon_code" class="form-control coupon_input" type="text" placeholder="Coupon code" value="">
                                            <button class="btn btn2 btn-thm bc_apply_coupon">{{__('Apply Coupon')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
                                        </div>
                                        <div>
                                            <div class="message alert-text mt-3"></div>
                                            <div class="form-group text-end"></div>
                                            @if(!empty($coupons = \Modules\Order\Helpers\CartManager::getCoupon()) and count($coupons) >0)
                                                <h6>{{__("List Coupon")}}</h6>
                                                <ul class="p-0 mb-3 list-coupons list-disc">
                                                    @foreach($coupons as $coupon)
                                                        <li class="item d-flex justify-content-between">
                                                            <div class="label">
                                                                {{ $coupon['code'] }}
                                                                <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="{{ $coupon['name']}}"></i>
                                                            </div>
                                                            <div class="val">
                                                                <a href="#" data-code="{{ $coupon['code'] }}" class="text-danger text-decoration-none bc_remove_coupon"> {{ __("[Remove]") }}
                                                                    <i class="fa fa-spin fa-spinner d-none"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn3" type="submit">{{__('Update cart')}} </button>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            @else
                <div class="my-3">
                    <div class="alert alert-warning">{{__("Your cart is empty!")}}</div>
                </div>
            @endif
        </div>
        <div class="col-span-4">
            <div class="card-body">
                <div class="row ">
                    <div class="col">
                        <hr class="my-3">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <p class="mb-1 h5"><b>{{__('Total')}}</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1 h5"><b>{{format_money(\Modules\Order\Helpers\CartManager::total())}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order_sidebar_widget style2">
                <h4 class="title">{{__('Cart Totals')}}</h4>
                <ul>
                    <li class="subtitle"><p>{{__('Subtotal')}} <span class="float-end">{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</span></p>
                        <hr>
                    </li>
                    <li>
                        @if($shipping = \Modules\Order\Helpers\CartManager::shippingTotal())
                            <div class="row justify-content-between">
                                <div class="col">
                                    <p class="mb-1"><b>{{__('Shipping')}}</b></p>
                                </div>
                                <div class="flex-sm-col col-auto">
                                    <p class="mb-1"><b>{{format_money($shipping)}}</b></p>
                                </div>
                            </div>
                        @endif
                        @if($discount = \Modules\Order\Helpers\CartManager::discountTotal())
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    <p><b>{{__("Discount")}}</b></p>
                                </div>
                                <div class="flex-sm-col col-auto">
                                    <p class="mb-1"><b>- {{format_money($discount)}}</b></p>
                                </div>
                            </div>
                        @endif
                    </li>
                    <li class="subtitle">
                        <hr>
                    </li>
                    <li class="subtitle"><p>{{__('Subtotal')}}
                            <span class="float-end totals text-thm">{{format_money(\Modules\Order\Helpers\CartManager::total())}}</span></p></li>
                </ul>
                <div class="ui_kit_button payment_widget_btn">
                    <a href="{{route('checkout')}}" class="btn btn-thm btn-block">{{__('PROCEED TO CHECKOUT')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
    <script src="{{theme_url('Base/order/cart.js?_v='.config('app.asset_version'))}}"></script>
@endpush
