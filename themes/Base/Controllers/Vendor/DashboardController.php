<?php
namespace Themes\Base\Controllers\Vendor;

use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;

class DashboardController extends \Modules\FrontendController
{
    public function index(){
        $this->checkPermission('vendor_access');

        $data = [
            'recent_orders'    => $this->getRecentOrders(),
            'top_cards'          => $this->getTopCardsReport(['range_type'=>'this_month']),
            'earning_chart_data'=>[],
            'page_title'=>__("Vendor Dashboard")
        ];

        return view('vendor.dashboard',$data);
    }

    protected function getRecentOrders(){
        return OrderItem::query()->where('vendor_id',auth()->id())->orderByDesc('id')->take(10)->with(['order'])->get();
    }
    protected function getTopCardsReport($filters = []){
        $res = [];
        $orderWhere = [];
        if(!empty($filters['range_type']))
        {
            switch ($filters['range_type'])
            {
                case "this_month":
                    $orderWhere[] = ["created_at",">=",date("Y-m-1 00:00:00",time())];
                    $orderWhere[] = ["created_at","<=",date("Y-m-t 23:59:59",time())];
                    break;
            }
        }
        $total_data = OrderItem::query()->where('vendor_id',auth()->id())->selectRaw('sum(`subtotal` - `discount_amount`) as total_price , sum( `subtotal` - `discount_amount` - `commission_amount` ) AS total_earning ')->where($orderWhere)->whereIn('status',[Order::COMPLETED])->first();
        $count_bookings = OrderItem::query()->where('vendor_id',auth()->id())->where($orderWhere)->whereIn('status',[Order::COMPLETED])->count('id');
        $count_items = OrderItem::query()->where('vendor_id',auth()->id())->where($orderWhere)->whereIn('status',[Order::COMPLETED])->sum('qty');
        $res[] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Revenue"),
            'amount' => format_money($total_data->total_price),
            'desc'   => __("Revenue this month"),
            'class'  => 'purple',
            'icon'   => 'fa fa-cart'
        ];
        $res[] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Earning"),
            'amount' => format_money($total_data->total_earning),
            'desc'   => __("Earning this month"),
            'class'  => 'pink',
            'icon'   => 'icon ion-ios-gift'
        ];
        $res[] = [

            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Orders"),
            'amount' => $count_bookings,
            'desc'   => __("Orders this month"),
            'class'  => 'info',
            'icon'   => 'icon ion-ios-pricetags'
        ];
        $res[] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Items"),
            'amount' => $count_items,
            'desc'   => __("Sold this month"),
            'class'  => 'success',
            'icon'   => 'icon ion-ios-pricetags'
        ];
        return $res;
    }
}
