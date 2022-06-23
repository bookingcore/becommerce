<ul id="gatewayList" class="list-unstyled" >
    @foreach($gateways as $k=>$gateway)
        <li>
            <div class="radio-option radio-box">
                <input type="radio" name="payment_gateway" value="{{$k}}" id="payment-{{$k}}" >
                <label for="payment-{{$k}}"  data-bs-toggle="collapse" data-bs-target="#paymentHtml{{$k}}" aria-expanded="false"  aria-controls="#paymentHtml{{$k}}">
                    @if($logo = $gateway->getDisplayLogo())
                        <img src="{{$logo}}" alt="{{$gateway->getDisplayName()}}">
                    @endif
                    {{$gateway->getDisplayName()}}
                </label>
                <div id="paymentHtml{{$k}}" class="gateway_html collapse"  data-bs-parent="#gatewayList">
                    {!! $gateway->getDisplayHtml() !!}
                </div>
            </div>
        </li>
    @endforeach
</ul>
<span class="input-error payment_gateway"></span>
