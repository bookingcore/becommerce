@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <h1 class="text-xl font-bold text-black text-center my-10">{{__("Shopping Cart")}}</h1>

    <div class="container">
        <div class="my-3">
            @include('global.message')
        </div>
        <div class="grid  grid-cols-1 sm:grid-cols-12 gap-6 pb-40 border-b">
            <div class="col-span-12 sm:col-span-8">
                @if(\Modules\Order\Helpers\CartManager::count())
                    <div class="shopping_cart_table">
                        <form action="{{route('cart.update_cart_item')}}" method="post">
                            @csrf
                            <div class="relative overflow-x-auto sm:rounded-lg">
                                <table class="text-center w-full whitespace-nowrap border border-slate-200  bg-white">
                                    <thead class="bg-slate-100 uppercase text-sm ">
                                    <tr>
                                        <th class=" py-5 px-4 font-medium">{{__("PRODUCT")}}</th>
                                        <th class=" py-5 px-4 font-medium">{{__('PRICE')}}</th>
                                        <th class=" py-5 px-4 font-medium">{{__('QUANTITY')}}</th>
                                        <th class=" py-5 px-4 font-medium">{{__('SUBTOTAL')}}</th>
                                        <th class="py-5 px-4 font-medium">{{__('REMOVE')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table_body  ">
                                    @foreach(\Modules\Order\Helpers\CartManager::items() as $cartItem)
                                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 text-base">
                                            <td class="py-5 w-5/6">
                                                <div class="flex">
                                                    @if(!empty($cartItem->model->image_id))
                                                        <a class="flex-none mx-3" href="{{$cartItem->getDetailUrl()}}">{!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>'w-24 h-24'])!!}</a>
                                                    @endif
                                                    <div >
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
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-5 font-medium ">{{format_money($cartItem->price)}}</td>
                                            <td class="py-5"><input class="cart_count rounded-full w-24 text-center border-slate-200" name="cart_item[{{$cartItem->id}}][qty]" value="{{$cartItem->qty}}" type="number"></td>
                                            <td class="py-5 font-medium">{{format_money($cartItem->sub_total)}}</td>
                                            <td class="py-5">
                                                <a class="close_img bc_delete_cart_item inline-block rounded-full hover:bg-gray-300 transition duration-200 p-3" data-bs-toggle="tooltip" data-id="{{$cartItem->id}}" data-remove="tr" title="{{__('Remove')}}" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout_form mt-10">
                                <div class="grid xl:grid-cols-12 gap-6">
                                    <div class="col-span-6">
                                        <div class="checkout_coupon section-coupon-form">
                                            <div class="flex  justify-between border border-dashed rounded py-1">
                                                <input name="coupon_code" class="form-control focus:outline-none coupon_input border-0" type="text" placeholder="Coupon code" value="">
                                                <button class="btn px-4 btn-thm bc_apply_coupon decoration-1">{{__('Apply Coupon')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
                                            </div>
                                            <div>
                                                <div class="message alert-text  mt-3"></div>
                                                <div class="form-group text-end"></div>

                                                @if(!empty($coupons = \Modules\Order\Helpers\CartManager::getCoupon()) and count($coupons) >0)
                                                    <h6 class="font-bold text-lg">{{__("List Coupon")}}</h6>
                                                    <ul class="p-0 mb-3 list-coupons list-disc">
                                                        @foreach($coupons as $coupon)
                                                            <li class="item flex justify-between mb-3">
                                                                <div class="label">
                                                                    {{ $coupon['code'] }}
                                                                    <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="{{ $coupon['name']}}"></i>
                                                                </div>
                                                                <div class="val">
                                                                    <a href="#" data-code="{{ $coupon['code'] }}" class="text-red-400 text-decoration-none bc_remove_coupon"> {{ __("[Remove]") }}
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
                                    <div class="col-span-6">
                                        <div class=" flex flex-row space-x-4 ">
                                            <a class="rounded font-medium  text-base inline-block w-full  py-4 text-center border-2 border-yellow-400 hover:bg-yellow-400 transition duration-200" href="{{route('product.index')}}">{{__('Continue Shopping')}} </a>
                                            <button class="rounded  text-base font-medium inline-block w-full  py-4 text-center bg-yellow-400 hover:bg-yellow-500 transition duration-200 focus:ring-4 focus:ring-yellow-400" type="submit">{{__('Update cart')}} </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                @else
                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                        <span class="font-medium">{{__("Your cart is empty!")}}</span>
                    </div>
                @endif
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="p-6 font-medium bg-white rounded-lg border shadow-md">
                    <h6 class="font-bold text-xl mb-6">{{__("Cart Total")}}</h6>
                    <div class="flex justify-between  mb-3">
                        <div class="">
                            {{__('Subtotal')}}
                        </div>
                        <div class="">
                            {{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}
                        </div>
                    </div>
                    @if($shipping = \Modules\Order\Helpers\CartManager::shippingTotal())
                        <div class="flex justify-between  mb-3">
                            <div class="">
                                {{__('Shipping')}}
                            </div>
                            <div class="">
                                {{format_money($shipping)}}
                            </div>
                        </div>
                    @endif
                    @if($discount = \Modules\Order\Helpers\CartManager::discountTotal())
                        <div class="flex justify-between mb-3">
                            <div >
                                {{__('Discount')}}
                            </div>
                            <div >
                                {{format_money($discount)}}
                            </div>
                        </div>
                    @endif
                    <hr class="my-4">
                    <div class="flex justify-between">
                        <div>{{__('Total')}}</div>
                        <div>{{format_money(\Modules\Order\Helpers\CartManager::total())}}</div>
                    </div>
                    <div class="">
                        <a href="{{route('checkout')}}" class="rounded font-medium inline-block w-full mt-4 py-4 text-center bg-yellow-400 hover:bg-yellow-500">{{__('Proceed To Checkout')}}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('footer')
    <script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
    <script src="{{theme_url('Base/order/cart.js?_v='.config('app.asset_version'))}}"></script>
@endpush
