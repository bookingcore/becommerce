<hr class="my-4">
<div class="form-check mb-3">
    <input type="checkbox" v-model="shipping_same_address" class="form-check-input" id="shipping_same_address" name="shipping_same_address"  value="1" @if(old('shipping_shipping_same_address',1)) checked @endif>
    <label class="form-check-label" for="shipping_same_address" >{{__('Shipping address is the same as my billing address')}}</label>
</div>
<div class="card" v-show="!shipping_same_address">
    <div class="card-header">
        {{__('Shipping Details')}}
    </div>
    <div class="card-body">
        @include('order.checkout.address-form',['prefix'=>'shipping_','address'=>$shipping])
    </div>
</div>
