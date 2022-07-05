<?php

namespace Modules\POS\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\FrontendController;
use Modules\Order\Models\Order;
use Modules\Order\Resources\Admin\OrderResource;
use Modules\Order\Rules\ValidOrderItems;

class OrderController extends FrontendController
{

    public function store(Request $request){
        if($this->hasPermission('pos_access')){
            return redirect('/');
        }
        $rules = [
            'customer_id'=>'required',
            'channel'=>'required'
        ];

        $rules = array_merge($rules,[
            'items.*.product_id'=>'required',
            'items.*.qty'=>'required|integer|gte:1',
            'items'=>['required',new ValidOrderItems()]
        ]);

        $order = new Order();
        $order->status = Order::COMPLETED;
        $order->order_date = Carbon::now();
        $order->channel = $request->input('channel');

        $request->validate($rules);


        $data = [
            'customer_id'=>$request->input('customer_id'),
            'discount_amount'=>$request->input('discount_amount'),
        ];
        if(!$order->isEditable()){
            unset($data['shipping_amount']);
        }

        $order->fillByAttr(array_keys($data),$data);
        $order->updateStatus($request->input('status'));
        $order->save();

        if($order->isEditable()){
            $order->saveItems($request->input('items'));
        }

        return $this->sendSuccess(['data'=>new OrderResource($order)],__("Order saved"));
    }
}
