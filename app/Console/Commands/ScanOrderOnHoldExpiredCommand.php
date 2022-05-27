<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Modules\Order\Models\Order;
use Modules\Product\Models\ProductOnHold;

class ScanOrderOnHoldExpiredCommand extends Command
{
    protected $signature = 'order:on_hold_expired';

    protected $description = 'Scan and change status order "on hold" expired to failed';

    public function handle()
    {
        $checkOnHoldExist = ProductOnHold::where('expired_at','<',now())->groupBy('order_id')->with('order')->get();
        if(!empty($checkOnHoldExist)){
            foreach ($checkOnHoldExist as $value){
                $order = $value->order;
                if($order->status === Order::ON_HOLD){
                    $order->updateStatus(Order::FAILED);
                }
                ProductOnHold::where('order_id',$order->id)->delete();
            }
        }
    }
}
