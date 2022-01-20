<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::query()->delete();
        OrderItem::query()->delete();
        $all_status = [
            'completed'
        ];
        for($i = 1; $i < 10;$i++){
            $order = new Order();
            $order->customer_id = 1;
            $order->status = $all_status[rand(0,count($all_status) - 1)];
            $order->created_at = date('Y-m-').rand(1,20);
            $order->save();

            $t = 0;
            // Items
            for($k = 1; $k < 5; $k++){
                $item = new OrderItem();
                $item->order_id = $order->id;
                $item->object_id = $k;
                $item->object_model = 'product';
                $item->price = rand(50,70);
                $item->qty = rand(1,5);
                $item->subtotal = $item->price * $item->qty;
                $item->commission_amount = $item->subtotal * 0.1;
                $item->tax_amount = $item->subtotal * 0.1;
                $item->status = $order->status;
                $item->vendor_id = 1;
                $item->created_at = $order->created_at;

                $t += $item->subtotal;
                $item->save();
            }

            $order->subtotal = $t;
            $order->tax_amount = $order->subtotal * 0.1;
            $order->total = $order->subtotal + $order->tax_amount;
            $order->save();
        }
    }
}
