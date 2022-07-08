<div class="card">
    <div class="card-header">
        {{__('Billing Details')}}
    </div>
    <div class="card-body">
        @include('order.checkout.address-form',['prefix'=>'billing_','address'=>$billing])
    </div>
</div>
