<div class="tab-content">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-booking-history">
            <thead>
            <tr>
                <th width="2%">{{__("Order")}}</th>
                <th>{{__("Suborders")}}</th>
                <th>{{__("Gateway")}}</th>
                <th>{{__("Date")}}</th>
                <th>{{__("Status")}}</th>
                <th>{{__("Total")}}</th>
                <th>{{__("Action")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                @php $data_order = []; $suborder = \Modules\Product\Models\OrderItem::where('order_id',$order->id)->get(); @endphp
                <tr data-order="{{$order->id}}">
                    <td><div class="order_id">#{{$order->id}}</div></td>
                    <td>
                        <div class="suborder">
                            <ul class="order-vendor list-unstyled">
                                @foreach($suborder as $item)
                                    @php $vendor = \App\User::find($item->vendor_id); array_push($data_order, $item->id); $a_item = [$item->id] @endphp
                                    <li>
                                        <strong><a href="#" class="btn-info-booking" data-is_suborder="true" data-toggle="modal" data-suborder="{{json_encode($a_item)}}">#{{$item->id}}</a></strong>
                                        –
                                        <small class="order-for-vendor">{{ __('for :vendor',['vendor'=>$vendor->getDisplayName()]) }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td>{{$order->gateway}}</td>
                    <td>{{display_date($order->created_at)}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{format_money($order->final_total)}}</td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-primary btn-info-booking" data-toggle="modal" data-is_suborder="false" data-suborder="{{json_encode($data_order)}}">
                            <span>{{ __('View') }}</span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="bravo-pagination"></div>
</div>
