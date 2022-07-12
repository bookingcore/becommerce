<div class="billing-form">
    <h4 class="title mb40">{{__('Billing Details')}}</h4>
    @includeIf('order.checkout.address-form',['prefix'=>'billing_','address'=>$billing])
</div>
