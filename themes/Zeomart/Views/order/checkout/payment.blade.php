@if(!empty($gateways))
    <div id="accordion-collapse" data-accordion="collapse" class="border border-gray-200 rounded p-8" data-active-classes="bg-none">
        <h2 class="title font-semibold mb-3 text-lg bg-none">{{__("Payment information")}}</h2>
        @foreach($gateways as $k=>$gateway)
            <div class="accordion-item border-0 border-b border-gray-200 last:border-b-0">
                <div class="flex items-center">
                    <input id="{{$k}}" name="payment_gateway" value="{{$k}}" type="radio" class="form-check-input mr-2 " required="">
                    <label id="accordion-collapse-heading-{{$k}}" class="form-check-label  w-full  py-5 font-medium text-left text-gray-500    hover:cursor-pointer"
                           data-accordion-target="#accordion-collapse-body-{{$k}}" aria-controls="accordion-collapse-body-{{$k}}" for="{{$k}}">
                        <span>{{$gateway->getDisplayName() ?? ''}}</span>
                    </label>
                </div>

                <div id="accordion-collapse-body-{{$k}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$k}}">
                    <div class="py-3">
                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                        {!! $gateway->getDisplayHtml() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="input-error text-red-400 my-3 payment_gateway">
    </div>
@endif
