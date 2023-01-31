<?php
$billing_address = $order->getJsonMeta('billing');
$shipping_address = $order->getJsonMeta('shipping');
$fields = [
    'company',
    'address',
    'address2',
    'city',
    'state',
    'postcode',
    'country',
    'phone',
    'email'
];
?>
<div class="relative overflow-x-auto mt-5">
    <table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0" class="w-full text-left whitespace-nowrap">
    <tr>
        <td style="border:0; padding:0;" valign="top" width="50%">
            <h3 class="address-title text-lg font-bold">{{__('Billing address')}}</h3>
            <address class="address">
                {{$billing_address['first_name'] ?? ''}} {{$billing_address['last_name'] ?? ''}}
                @foreach($fields as $field)
                    @if(!empty($billing_address[$field]))
                        @switch($field)
                            @case("country")
                                <br>{{get_country_name($billing_address[$field] ?? '')}}
                            @break
                            @default
                                <br>{{$billing_address[$field] ?? ''}}
                            @break
                        @endswitch
                    @endif
                @endforeach
            </address>
        </td>
        @if( !empty($shipping_address) )
        <td style="border:0; padding:0;" valign="top" width="50%">
            <h3 class="address-title text-lg font-bold">{{__('Shipping address')}}</h3>
            <address class="address">
                {{$shipping_address['first_name'] ?? ''}} {{$shipping_address['last_name'] ?? ''}}
                @foreach($fields as $field)
                    @if(!empty($shipping_address[$field]))
                        @switch($field)
                            @case("country")
                            <br>{{get_country_name($shipping_address[$field] ?? '')}}
                            @break
                            @default
                            <br>{{$shipping_address[$field] ?? ''}}
                            @break
                        @endswitch
                    @endif
                @endforeach
            </address>
        </td>
        @endif
    </tr>
</table>
</div>
<br>
