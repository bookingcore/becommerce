<hr class="my-4">
<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="shipping_same_address" name="shipping_same_address"  value="1" @if(empty($shipping->country))checked @endif>
    <label class="form-check-label" for="shipping_same_address" >{{__('Shipping address is the same as my billing address')}}</label>
</div>
<div class="shipping-form" v-show="!shipping_same_address">
    <h4 class="title mb40">{{__('Shipping Details')}}</h4>
    @include('order.checkout.address-form',['prefix'=>'shipping_','address'=>$shipping])
</div>

