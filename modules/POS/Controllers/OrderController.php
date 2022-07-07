<?php

namespace Modules\POS\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\FrontendController;
use Modules\Order\Models\Order;
use Modules\Order\Resources\Admin\OrderResource;
use Modules\Order\Rules\ValidOrderItems;

class OrderController extends FrontendController
{

    public function store(Request $request){
        if(!$this->hasPermission('pos_access')){
            return $this->sendError(__("You are not allowed to access this function"));
        }
        $rules = [
            'customer_id'=>'required|exists:users,id',
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

        /**
         * @var User $customer
         */
        $customer = User::find($request->input('customer_id'));

        $data = [
            'customer_id'=>$request->input('customer_id'),
            'discount_amount'=>$request->input('discount_amount'),
            'email'=>$customer->email,
            'phone'=>$customer->phone,
            'first_name'=>$customer->first_name,
            'last_name'=>$customer->last_name,
        ];

        $order->fillByAttr(array_keys($data),$data);
        $order->save();
        $order->saveItems($request->input('items'));

        $billing_address = $customer->billing_address;
        if(!$billing_address){
            $billing_address = $customer->getDefaultAddress();
        }
        $metas = [
            'billing'=>$billing_address,
        ];
        foreach ($metas as $k=>$meta){
            $order->addMeta($k,$meta);
        }

        // Tax
        $order->addTax($billing_address['country'] ?? '',$billing_address['country'] ?? '');
        $order->syncTaxChange();
        $order->save();

        return $this->sendSuccess(['data'=>new OrderResource($order)],__("Order saved"));
    }
}
