@extends("layouts.app")
@section('content')
    @includeIf('global.breadcrumb')
    <div class="container">
        @include('global.message')
        @if(\Modules\Order\Helpers\CartManager::count())

            <div class="section-title my-4">
                <h3>{{__('Shopping Cart')}}</h3>
            </div>
            <div class="row d-flex justify-content-center align-items-center py-5">
                <form action="{{route('cart.update_cart_item')}}" method="post">
                    <div class="col">
                        @csrf
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('Product Detail')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th scope="col">{{__('Total')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\Modules\Order\Helpers\CartManager::items() as $cartItem)
                                    <tr>
                                        @if($cartItem->model)
                                            <td scope="row">
                                                <div class="d-flex align-items-center">
                                                    @if(!empty($cartItem->model->image_id))
                                                        <a href="{{$cartItem->getDetailUrl()}}"> {!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>'img-fluid rounded-3 w-75px'])!!}</a>
                                                    @endif
                                                    <div class="flex-column ms-4">
                                                        <p class="mb-2"><a href="{{$cartItem->getDetailUrl()}}"><strong>{{$cartItem->name}}</strong></a></p>
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
                                        @else
                                            <td scope="row">
                                                <div class="d-flex align-items-center">
                                                    <div></div>
                                                    <div class="flex-column ms-4">
                                                        <p class="mb-2">{{$cartItem->name}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif

                                        <td class="align-middle">
                                            <p class="mb-0" style="font-weight: 500;">{{format_money($cartItem->price)}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row cart-item-qty">
                                                <button class="btn btn-link px-2 down"><i class="fa fa-minus"></i></button>
                                                <input name="cart_item[{{$cartItem->id}}][qty]" class="form-control form-control-sm w-50px" type="number" min="0"
                                                       placeholder="{{$cartItem->qty}}"
                                                       value="{{$cartItem->qty}}">
                                                <button class="btn btn-link px-2 up"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <p class="mb-0" style="font-weight: 500;">{{format_money($cartItem->subTotal)}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" data-bs-toggle="tooltip" title="{{__('Remove')}}" class="text-danger axtronic_delete_cart_item" data-id="{{$cartItem->id}}" data-remove="tr"> <i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="axtronic-section__cart-actions d-flex justify-content-between">
                            <a class="btn btn-sm btn-warning" href="{{route('product.index')}}"><i class="fa fa-arrow-left"></i> {{__('Back to Shop')}}</a>
                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa  fa-refresh"></i> {{__('Update cart')}} </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card section-coupon-form">
                        <div class="card-header font-weight-bold">{{__('Coupon Discount')}}</div>
                        <div class="card-body">
                            <div class="form-group">
                                <input name="coupon_code" class="form-control" type="text" placeholder="" value="">
                            </div>
                            <div class="message alert-text mt-2"></div>
                            <div class="form-group text-end">
                                <button class="btn btn-primary axtronic_apply_coupon">{{__('Apply')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
                            </div>
                            @if(!empty($coupons = \Modules\Order\Helpers\CartManager::getCoupon()) and count($coupons) >0)
                                <h6>{{__("List Coupon")}}</h6>
                                <ul class="p-0 mb-3 list-coupons list-disc">
                                    @foreach($coupons as $coupon)
                                        <li class="item d-flex justify-content-between">
                                            <div class="label">
                                                {{ $coupon->code }}
                                                <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="{{ $coupon->name}}"></i>
                                            </div>
                                            <div class="val">
                                                <a href="#" data-code="{{ $coupon->code }}" class="text-danger text-decoration-none axtronic_remove_coupon"> {{ __("[Remove]") }}
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
                <div class="col-12 col-lg-4">

                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-header font-weight-bold">{{__('Order')}}</div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col">
                                    <div class="row justify-content-between">
                                        <div class="col-4">
                                            <p class="mb-1"><b>{{__('Subtotal')}}</b></p>
                                        </div>
                                        <div class="flex-sm-col col-auto">
                                            <p class="mb-1"><b>{{format_money(\Modules\Order\Helpers\CartManager::subtotal())}}</b></p>
                                        </div>
                                    </div>
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
                        <div class="card-footer">
                            <a class="btn btn-primary w-100" href="{{route('checkout')}}">{{__('Proceed to checkout')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="my-3">
                <div class="alert alert-warning">{{__("Your cart is empty!")}}</div>
            </div>
        @endif
    </div>
@endsection
@section('footer')
    <script src="{{theme_url('Base/order/cart.js?_v='.config('app.asset_version'))}}"></script>
@endsection
