<div class="section-coupon-form">
    <input type="hidden" name="cart_id" value="{{$cart->code}}">
    <div class="input-group mb-3 flex">
        <input name="coupon_code" class="form-control border rounded border-gray-300 grow" type="text" placeholder="{{__("Discount")}}" value="">
        <button class="btn rounded font-medium inline-block flex-none ml-3 px-4  text-center bg-yellow-400 hover:bg-yellow-500 bc_apply_coupon">{{__('Apply')}} <i class="fa fa-spin  fa-spinner d-none"></i></button>
    </div>
    <div class="message text-red-400 my-2"></div>
    @if(!empty($coupons = $cart->coupons) and count($coupons) >0)

    <h6>{{__("List Coupon")}}</h6>
    <ul class="p-0 mb-3 list-coupons list-disc">
        @foreach($coupons as $coupon)
            <li class="item flex justify-between mb-3">
                <div class="label">
                    {{ $coupon->code }}
                    <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="{{ $coupon->name}}"></i>
                </div>
                <div class="val">
                    <a href="#" data-code="{{ $coupon->code }}" class="text-red-400  text-decoration-none bc_remove_coupon"> {{ __("[Remove]") }}
                        <i class="fa fa-spin fa-spinner d-none"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
@endif
</div>
