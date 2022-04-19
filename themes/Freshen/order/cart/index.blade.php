@extends("layouts.app")
@section('content')
    @includeIf('global.breadcrumb')
    <div class="container">
        @include('global.message')
        @if(\Modules\Order\Helpers\CartManager::count())
            <div class="shopping_cart_tabs">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                        <div class="row">
                            <div class="col-lg-8 col-xl-9">
                                <div class="shopping_cart_table">
                                    <table class="table table-responsive table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">PRODUCT</th>
                                            <th scope="col">PRICE</th>
                                            <th scope="col">QUANTITY</th>
                                            <th scope="col">SUBTOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table_body">
                                        @foreach(\Modules\Order\Helpers\CartManager::items() as $cartItem)
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
                                        <tr>
                                            <th scope="row">
                                                <ul class="cart_list">
                                                    <li class="list-inline-item"><a class="close_img" href="#"><img src="images/shop/close.png" alt=""></a></li>
                                                @if(!empty($cartItem->model->image_id))
                                                        <li class="list-inline-item pr10"><a href="{{$cartItem->getDetailUrl()}}">{!! get_image_tag($cartItem->model->image_id ?? '','thumb',['class'=>'img-fluid'])!!}</a></li>
                                                    @endif
                                                    <li class="list-inline-item"><a class="cart_title" href="#">Silver Heinz Ketchup 350 ml</a></li>
                                                </ul>
                                            </th>
                                            <td>$7.63</td>
                                            <td><input class="cart_count text-center" placeholder="2" type="number"></td>
                                            <td class="text-thm">$347.63</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="checkout_form mt30">
                                        <div class="checkout_coupon">
                                            <form class="df db-520">
                                                <input class="form-control coupon_input" type="search" placeholder="Coupon code" aria-label="Search">
                                                <button type="button" class="btn btn2 btn-thm">Apply Coupon</button>
                                                <button type="button" class="btn btn3">Update Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-3">
                                <div class="order_sidebar_widget style2">
                                    <h4 class="title">Cart Totals</h4>
                                    <ul>
                                        <li class="subtitle"><p>Subtotal <span class="float-end">$907.00</span></p> <hr></li>
                                        <li>
                                            <div class="ui_kit_radiobox shopping_cart_radio_box">
                                                <div class="radio">
                                                    <input id="radio_one" name="radio" type="radio" checked="">
                                                    <label for="radio_one"><span class="car_for_shipping">Shipping</span><span class="radio-label"></span>Flat rate: <span class="fwb text-thm">$20.00</span></label>
                                                </div>
                                                <div class="radio">
                                                    <input id="radio_two" name="radio" type="radio">
                                                    <label for="radio_two"><span class="radio-label"></span>Free shipping</label>
                                                </div>
                                                <div class="radio">
                                                    <input id="radio_three" name="radio" type="radio">
                                                    <label for="radio_three"><span class="radio-label"></span>Local pickup: <span class="fwb text-thm">$25.00</span></label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio_four"><span class="radio-label"></span> Shipping to AL.</label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio_four"><span class="radio-label"></span> <span class="fz14 fwb tdu text-thm">Change address</span></label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="subtitle"><hr></li>
                                        <li class="subtitle"><p>Subtotal <span class="float-end totals text-thm">$907.00</span></p></li>
                                    </ul>
                                    <div class="ui_kit_button payment_widget_btn">
                                        <button type="button" class="btn btn-thm btn-block">PROCEED TO CHECKOUT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                        <div class="row">
                            <div class="col-lg-8 col-xl-9">
                                <div class="checkout_form style2">
                                    <h4 class="title mb40">Billing Details</h4>
                                    <div class="checkout_coupon ui_kit_button">
                                        <form class="form2" id="coupon_form" name="contact_form" action="#" method="post">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">First name</label>
                                                        <input class="form-control form_control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Last name</label>
                                                        <input class="form-control form_control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Company name (optional)</label>
                                                        <input class="form-control form_control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Country / Region *</label>
                                                        <div class="checkout_country_form actegory">
                                                            <div class="select"><select class="custom_select_dd s-hidden" id="selectbox_alCategory2">
                                                                    <option>Country</option>
                                                                    <option value="Turkey">Turkey</option>
                                                                    <option value="United Kingdom">United Kingdom</option>
                                                                    <option value="United States">United States</option>
                                                                    <option value="Ukraine">Ukraine</option>
                                                                    <option value="Uruguay">Uruguay</option>
                                                                    <option value="UK">UK</option>
                                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                                </select><div class="styledSelect">Country</div><ul class="options"><li rel="Country">Country</li><li rel="Turkey">Turkey</li><li rel="United Kingdom">United Kingdom</li><li rel="United States">United States</li><li rel="Ukraine">Ukraine</li><li rel="Uruguay">Uruguay</li><li rel="UK">UK</li><li rel="Uzbekistan">Uzbekistan</li></ul></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Street address *</label>
                                                        <input class="form-control form_control mb10" type="text">
                                                        <input class="form-control form_control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Town / City *</label>
                                                        <input class="form-control form_control" type="number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">State *</label>
                                                        <div class="checkout_country_form actegory">
                                                            <div class="select"><select class="custom_select_dd s-hidden" id="selectbox_alCategory3">
                                                                    <option>Country</option>
                                                                    <option value="Istanbul">Istanbul</option>
                                                                    <option value="London">London</option>
                                                                    <option value="NewYork">New York</option>
                                                                    <option value="Paris">Paris</option>
                                                                    <option value="Dubai">Dubai</option>
                                                                    <option value="Rome">Rome</option>
                                                                    <option value="Singapore">Singapore</option>
                                                                </select><div class="styledSelect">Country</div><ul class="options"><li rel="Country">Country</li><li rel="Istanbul">Istanbul</li><li rel="London">London</li><li rel="NewYork">New York</li><li rel="Paris">Paris</li><li rel="Dubai">Dubai</li><li rel="Rome">Rome</li><li rel="Singapore">Singapore</li></ul></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">ZIP *</label>
                                                        <input class="form-control form_control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Phone *</label>
                                                        <input name="form_phone" class="form-control form_control" type="number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Your Email</label>
                                                        <input name="form_email" class="form-control form_control email" type="email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb0">
                                                        <label class="ai_title">Order notes (optional)</label>
                                                        <textarea name="form_message" class="form-control" rows="12" placeholder=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-3">
                                <div class="order_sidebar_widget mb30">
                                    <h4 class="title">Your Order</h4>
                                    <ul>
                                        <li class="subtitle"><p>Product <span class="float-end">Subtotal</span></p> <hr></li>
                                        <li><p class="product_name_qnt">Silver Heinz Ketchup X 2 <span class="float-end">$259.00</span></p></li>
                                        <li><p class="product_name_qnt">Pineapple (Tropical Gold) x 3 <span class="float-end">$259.00</span></p></li>
                                        <li><p class="product_name_qnt">Pineapple (Tropical Gold) x 4 <span class="float-end">$259.00</span></p></li>
                                        <li class="subtitle"><hr></li>
                                        <li>
                                            <div class="ui_kit_radiobox shopping_cart_radio_box">
                                                <div class="radio">
                                                    <input id="radio_one" name="radio" type="radio" checked="">
                                                    <label for="radio_one"><span class="car_for_shipping">Shipping</span><span class="radio-label"></span>Flat rate: <span class="fwb text-thm">$20.00</span></label>
                                                </div>
                                                <div class="radio">
                                                    <input id="radio_two" name="radio" type="radio">
                                                    <label for="radio_two"><span class="radio-label"></span>Free shipping</label>
                                                </div>
                                                <div class="radio">
                                                    <input id="radio_three" name="radio" type="radio">
                                                    <label for="radio_three"><span class="radio-label"></span>Local pickup: <span class="fwb text-thm">$25.00</span></label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio_four"><span class="radio-label"></span> Shipping to AL.</label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio_four"><span class="radio-label"></span> <span class="fz14 fwb tdu text-thm">Change address</span></label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="subtitle"><hr></li>
                                        <li class="subtitle"><p>Subtotal <span class="float-end totals text-thm">$907.00</span></p></li>
                                        <li class="subtitle"><hr></li>
                                    </ul>
                                    <div class="ui_kit_radiobox checkout">
                                        <div class="radio">
                                            <input id="radio_five" name="radio" type="radio" checked="">
                                            <label for="radio_five"><span class="radio-label"></span> Direct bank transfer</label>
                                        </div>
                                        <div class="bt_details">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.Your order will not be shipped until the funds have.</p>
                                        </div>
                                        <div class="radio">
                                            <input id="radio_six" name="radio" type="radio">
                                            <label for="radio_six"><span class="radio-label"></span> Cash on delivery</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio_seven" name="radio" type="radio">
                                            <label for="radio_seven"><span class="radio-label"></span> PayPal What is PayPal? <img src="images/resource/payment.png" alt="payment.png"></label>
                                        </div>
                                    </div>
                                    <div class="ui_kit_button payment_widget_btn">
                                        <button type="button" class="btn btn-thm btn-block">PLACE ORDER</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="prder" role="tabpanel" aria-labelledby="prder-tab">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="order_complete_message text-center">
                                    <div class="icon bgc-thm"><span class="fa fa-check text-white"></span></div>
                                    <h2>Your Order Is Completed !</h2>
                                    <p class="fz14">Thank you. Your order has been received.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="shop_order_box mt40">
                                    <div class="order_list_raw">
                                        <ul>
                                            <li class="list-inline-item">
                                                <p>Order Number</p>
                                                <h5>13119</h5>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Date</p>
                                                <h5>27/07/2021</h5>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Total</p>
                                                <h5>$40.10</h5>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Payment Method</p>
                                                <h5>Direct Bank Transfer</h5>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="order_details">
                                        <h4 class="title text-center mb40">ORDER DETAILS</h4>
                                        <div class="od_content">
                                            <ul>
                                                <li class="subtitle bb1 mb20 pb5"><p>Product <span class="float-end">Subtotal</span></p></li>
                                                <li><p class="product_name_qnt">Silver Heinz Ketchup X 2 <span class="float-end">$259.00</span></p></li>
                                                <li><p class="product_name_qnt">Pineapple (Tropical Gold) x 3 <span class="float-end">$259.00</span></p></li>
                                                <li><p class="product_name_qnt">Pineapple (Tropical Gold) x 4 <span class="float-end">$259.00</span></p></li>
                                                <li class="subtitle bb1 mb15 mt20"><p>Subtotal <span class="float-end">$59.00</span></p></li>
                                                <li class="subtitle bb1 mb20"><p>Shipping <span class="float-end fwn_bd_color">Free shipping</span></p></li>
                                                <li class="subtitle bb1 mb20"><p>Vat <span class="float-end totals color-orose">$9.00</span></p></li>
                                                <li class="subtitle bb1 mb20"><p>Payment Method <span class="float-end fwn_bd_color">Direct bank transfer</span></p></li>
                                                <li class="subtitle"><p>Total <span class="float-end totals text-thm">$259.00</span></p></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


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
                                            <a href="#" data-bs-toggle="tooltip" title="{{__('Remove')}}" class="text-danger bc_delete_cart_item" data-id="{{$cartItem->id}}" data-remove="tr"> <i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bc-section__cart-actions d-flex justify-content-between">
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
