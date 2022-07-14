@extends("layouts.app")
@section('content')
    @include('global.breadcrumb')
    <div class="order-confirmation">
        <div class="container">
            <div class="card w-full lg:w-3/5 m-auto">
                <div class="card-header">
                    <h4 class="text-center text-2xl mb-2 font-bold">
                        @switch($row->status)
                            @case('completed')
                                <svg class="w-20 h-20 mx-auto mb-3 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg>
                                @break
                            @default
                                <svg class="w-20 h-20 mx-auto mb-3 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S224 177.7 224 160C224 142.3 238.3 128 256 128zM296 384h-80C202.8 384 192 373.3 192 360s10.75-24 24-24h16v-64H224c-13.25 0-24-10.75-24-24S210.8 224 224 224h32c13.25 0 24 10.75 24 24v88h16c13.25 0 24 10.75 24 24S309.3 384 296 384z"/></svg>
                                @break
                        @endswitch
                        @switch($row->status)
                            @case('completed')
                            {{__('Your order is completed!')}}
                            @break
                            @default
                            {{__('Your order detail')}}
                            @break
                        @endswitch
                    </h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        @switch($row->status)
                            @case('completed')
                            {{__('Thank you. Your order has been received.')}}
                            @break
                            @default
                            {{__('Here is your order detail')}}
                            @break
                        @endswitch
                    </div>
                    <ul class="order-info border border-gray-200 border-dashed rounded flex flex-wrap justify-center gap-20 p-9 my-5 ">
                        <li class="flex flex-col">
                            <span>{{__('Order Number')}}</span>
                            <strong>#{{$row->id}}</strong>
                        </li>

                        <li class="flex flex-col">
                            <span>{{__('Date')}}</span>
                            <strong>{{display_date($row->created_at)}}</strong>
                        </li class="flex flex-col">

                        <li class="flex flex-col">
                            <span>{{__('Total')}}</span>
                            <strong>{{format_money($row->total)}}</strong>
                        </li class="flex flex-col">

                        <li class="flex flex-col">
                            <span>{{__('Payment Method')}}</span>
                            <strong>{{$row->gateway_obj ? $row->gateway_obj->getDisplayName() : ''}}</strong>
                        </li>
                        <li class="flex flex-col">
                            <span>{{__('Status')}}</span>
                            <strong>{{$row->status_text}}</strong>
                        </li>
                    </ul>
                    <div class="order-box border border-gray-200 rounded p-9">
                        <h4 class="text-xl font-bold mb-3">{{__('Order details')}}</h4>
                        <div class="relative overflow-x-auto ">
                            <table class="w-full text-left whitespace-nowrap">
                            <thead>
                            <tr class="border-b border-gray-200">
                                <th class="py-2"><strong>{{__('Product')}}</strong></th>
                                <th class="text-right" width="20%"><strong>{{__('Subtotal')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($row->items as $orderItem)
                                <?php $model = $orderItem->model; ?>
                                <tr class="cart-item">
                                    <td class="product-name py-2">{{$model ? $model->title : $orderItem->name }} x{{$orderItem->qty}}

                                        @if(!empty($orderItem->meta['package']))
                                            <div class="mt-3">{{__('Package: ')}} {{package_key_to_name($orderItem->meta['package'])}} ({{format_money($orderItem->price)}})</div>
                                        @endif
                                        @if(!empty($orderItem->meta['extra_prices']))
                                            <div class="mt-3"><strong>{{__("Extra Prices:")}}</strong></div>
                                            <ul class="list-unstyled mt-2">
                                                @foreach($orderItem->meta['extra_prices'] as $extra_price)
                                                    <li>{{$extra_price['name'] ?? ''}} : {{format_money($extra_price['price'] ?? 0)}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="product-total text-right font-semibold ">{{format_money($orderItem->subtotal)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            @if(!empty($row->shipping_amount) and $row->shipping_amount > 0)
                                <tr class="shipping-amount border-t border-gray-200">
                                    <td class="font-semibold py-2">{{__('Shipping Amount')}}</td>
                                    <td class="text-right font-semibold"><span class="amount">{{format_money($row->shipping_amount )}}</span></td>
                                </tr>
                            @endif
                            @if(!empty($row->discount_amount) and $row->discount_amount > 0)
                                <tr class="discount-amount border-t border-gray-200">
                                    <td class="font-semibold py-2">{{__('Discount Amount')}}</td>
                                    <td><span class="amount text-right font-semibold">-{{format_money($row->discount_amount )}}</span></td>
                                </tr>
                            @endif
                            @if(!empty($row->tax_amount) and $row->tax_amount > 0)
                                <tr class="tax-amount border-t border-gray-200">
                                    <td class="font-semibold py-2">
                                        {{__('Tax')}} @if($row->getMeta('prices_include_tax') == "yes")<span >({{ __("include") }})</span> @endif
                                    </td>
                                    <td class="text-right font-semibold"><span class="amount ">{{format_money($row->tax_amount )}}</span></td>
                                </tr>
                            @endif
                            <tr class="order-total border-t border-gray-200">
                                <td class="font-semibold py-3">{{__('Total')}}</td>
                                <td class="text-right font-semibold"><span class="amount">{{format_money($row->total)}}</span></td>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                    <hr>
                    @include('order.emails.parts.order-address',['order'=>$row])
                </div>
            </div>
        </div>
    </div>
@endsection
