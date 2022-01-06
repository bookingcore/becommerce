<?php
namespace Modules\Dashboard\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Order\Models\Order;

class DashboardController extends AdminController
{
    public function index()
    {
        $f = strtotime('monday this week');
        $data = [
            'recent_orders'    => $this->getRecentBookings(),
            'top_cards'          => $this->getTopCardsReport(['range_type'=>'this_month']),
            'earning_chart_data' => [],//Order::getDashboardChartData($f, time())
        ];
        return view('Dashboard::index', $data);
    }

    protected function getRecentBookings(){
        return Order::query()->orderByDesc('id')->take(10)->get();
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
        $total_data = Order::query()->selectRaw('sum(`total`) as total_price , sum( `total` - `tax_amount` ) AS total_earning, sum(tax_amount) as total_tax ')->where($orderWhere)->whereIn('status',[Order::COMPLETED])->first();
        $count_bookings = Order::query()->where($orderWhere)->whereIn('status',[Order::COMPLETED])->count('id');

        $res[] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Revenue"),
            'amount' => format_money($total_data->total_price),
            'desc'   => __("Revenue this month"),
            'class'  => 'purple',
            'icon'   => 'icon ion-ios-cart'
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
            'title'  => __("Total Tax"),
            'amount' => format_money($total_data->total_tax),
            'desc'   => __("Total tax this month"),
            'class'  => 'success',
            'icon'   => 'icon ion-ios-flash'
        ];
        return $res;
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Order::getDashboardChartData(strtotime($from), strtotime($to))
                ]);
                break;
        }
    }
}
