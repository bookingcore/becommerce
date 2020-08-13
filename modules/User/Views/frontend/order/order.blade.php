<div class="tab-content">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-booking-history">
            <thead>
            <tr>
                <th>{{__("Suborders")}}</th>
                <th>{{__("Gateway")}}</th>
                <th>{{__("Date")}}</th>
                <th>{{__("Status")}}</th>
                <th>{{__("Total")}}</th>
                <th>{{__("Action")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $key => $order)
                @php $data_order = []; $suborder = \Modules\Product\Models\OrderItem::where('order_id',$order->id)->get(); @endphp
                <tr data-order="{{$order->id}}">
                    <td>
                        <ul class="order-vendor list-unstyled">
                            @foreach($suborder as $item)
                                @php
                                    $product = \Modules\Product\Models\Product::where('id',$item->product_id)->first();
                                    array_push($data_order, $item->id);
                                @endphp
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="thumb">
                                                {!! get_image_tag($product->image_id) !!}
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('product.detail',['slug'=>$product->slug]) }}">{{$item->product_name}}</a>
                                            <div>{{ __('Quantity: :num',['num'=>$item->qty]) }}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{$order->gateway}}</td>
                    <td>{{display_date($order->created_at)}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{format_money($order->final_total)}}</td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-primary btn-info-booking" data-toggle="modal" data-target="#order-modal-{{$order->id}}">
                            <span>{{ __('View') }}</span>
                        </button>
                        <div class="modal fade" id="order-modal-{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            @include('User::frontend.order.order-modal')
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="bravo-pagination">
        {!! $orders->links() !!}
    </div>
</div>
