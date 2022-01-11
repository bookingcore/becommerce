@extends("layouts.app")
@section('content')
    <section class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{home_url()}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">{{__('Shop')}}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{$page_title}}</li>
                </ol>
            </nav>
            @if(\Modules\Order\Helpers\CartManager::count())

                <div class="section-title my-4">
                    <h3>{{__('Shopping Cart')}}</h3>
                </div>
                <div class="row d-flex justify-content-center align-items-center py-5">
                    <div class="col">
                        <form action="{{route('cart.update_cart_item')}}" method="post">
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
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        @if($cartItem->model->image_id)
                                                            <a href="{{$cartItem->getDetailUrl()}}"> {!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>'img-fluid rounded-3 w-75px'])!!}</a>
                                                        @endif
                                                        <div class="flex-column ms-4">
                                                            <p class="mb-2"><a href="{{$cartItem->getDetailUrl()}}">{{$cartItem->name}}</a></p>
                                                            @if(!empty($cartItem->author))
                                                                <p class="mb-0 small">{{__('Sold By:')}} {{$cartItem->author}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </th>
                                            @else
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <div></div>
                                                        <div class="flex-column ms-4">
                                                            <p class="mb-2">{{$cartItem->name}}</p>
                                                        </div>
                                                    </div>
                                                </th>
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
                                                <a href="#" data-bs-toggle="tooltip" title="{{__('Remove')}}" class="text-danger bc_delete_cart_item" data-id="{{$cartItem->id}}" data-remove="tr"> <i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="bc-section__cart-actions d-flex justify-content-between">
                            <a class="btn btn-sm btn-warning" href="{{route('product.index')}}"><i class="fa fa-arrow-left"></i> {{__('Back to Shop')}}</a>
                            <button class="btn btn-sm btn-primary" href=""><i class="fa  fa-refresh"></i> {{__('Update cart')}} </button>
                        </div>
                    </div>
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
                                    <button class="btn btn-primary bc_apply_coupon">{{__('Apply')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
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
                                                    <a href="#" data-code="{{ $coupon->code }}" class="text-danger text-decoration-none bc_remove_coupon"> {{ __("[Remove]") }}
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
                        <div class="card">
                            <div class="card-header font-weight-bold">{{__('Calculate shipping')}}</div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <select class="form-control">
                                        <option value="1">America</option>
                                        <option value="2">Italia</option>
                                        <option value="3">Vietnam</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control" type="text" placeholder="Town/City">
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control" type="text" placeholder="Postcode/Zip">
                                </div>
                                <div class="form-group text-end">
                                    <button class="btn btn-primary">{{__('Update')}}</button>
                                </div>
                            </div>
                        </div>
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
                                        <div class="row justify-content-between">
                                            <div class="col">
                                                <p class="mb-1"><b>{{__('Shipping')}}</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b>{{format_money(0)}}</b></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <p><b>{{__("Discount")}}</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b>- {{format_money(\Modules\Order\Helpers\CartManager::discountTotal())}}</b></p>
                                            </div>
                                        </div>
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
    </section>
@endsection
@section('footer')
    <script src="{{theme_url('base/order/cart.js')}}"></script>
@endsection
