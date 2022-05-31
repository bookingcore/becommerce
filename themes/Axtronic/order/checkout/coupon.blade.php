<div class="section-coupon-form">
    <input type="hidden" name="cart_id" value="{{$cart->code}}">
    <div class="input-group mb-3">
        <input name="coupon_code" class="form-control" type="text" placeholder="{{__("Discount")}}" value="">
        <button class="btn btn-primary axtronic_apply_coupon">{{__('Apply')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
    </div>
    <div class="message alert-text mt-2"></div>
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
