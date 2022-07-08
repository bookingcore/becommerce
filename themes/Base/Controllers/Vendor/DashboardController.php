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
            'top_cards'          => $this->getTopCardsReport(['range_type'=>'this_period','from'=>request('from'),'to'=>request('to')]),
            'earning_chart_data'=>$this->getChartData(request('from'),request('to')),
            'page_title'=>__("Store Dashboard")
        ];

        return view('vendor.dashboard',$data);
    }

    protected function getRecentOrders(){
        return OrderItem::search([
            'vendor_id'=>auth()->id()
        ])->orderByDesc('id')->with(['order','product'])->limit(10)->get();
    }
    protected function getTopCardsReport($filters = []){
        $res = [];
        $orderWhere = [];
        $from_date = $filters['from'] ?? date('Y-m-01');
        $to_date = $filters['to'] ?? date('Y-m-t');

        $orderWhere[] = ["created_at",">=",date("Y-m-d 00:00:00",strtotime($from_date))];
        $orderWhere[] = ["created_at","<=",date("Y-m-d 23:59:59",strtotime($to_date))];

        $total_data = OrderItem::query()->where('vendor_id',auth()->id())->selectRaw('sum(`subtotal` - `discount_amount`) as total_price , sum( `subtotal` - `discount_amount` - `commission_amount` ) AS total_earning ')->where($orderWhere)->whereIn('status',[Order::COMPLETED])->first();
        $count_bookings = OrderItem::query()->where('vendor_id',auth()->id())->where($orderWhere)->whereIn('status',[Order::COMPLETED])->count('id');
        $count_items = OrderItem::query()->where('vendor_id',auth()->id())->where($orderWhere)->whereIn('status',[Order::COMPLETED])->sum('qty');
        $res['revenue'] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Revenue"),
            'amount' => format_money($total_data->total_price),
            'desc'   => __("Revenue this period"),
            'class'  => 'purple',
            'icon'   => 'fa fa-credit-card'
        ];
        $res['earning'] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Earning"),
            'amount' => format_money($total_data->total_earning),
            'desc'   => __("Earning this period"),
            'class'  => 'pink',
            'icon'   => 'fa fa-credit-card'
        ];
        $res['orders'] = [

            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Orders"),
            'amount' => $count_bookings,
            'desc'   => __("Orders this period"),
            'class'  => 'info',
            'icon'   => 'fa fa-basket'
        ];
        $res['items'] = [
            'size'   => 6,
            'size_md'=>3,
            'title'  => __("Items"),
            'amount' => $count_items,
            'desc'   => __("Sold this period"),
            'class'  => 'success',
            'icon'   => 'fa fa-database'
        ];
        return $res;
    }

    public function getChartData($from, $to)
    {
        $from = $from ?? date('Y-m-01');
        $to = $to ?? date('Y-m-t');

        $data = [
            'labels'   => [],
            'datasets' => [
                [
                    'label'           => __("Total Revenue"),
                    'data'            => [],
                    'backgroundColor' => '#8892d6',
                    'stack'           => 'group-total',
                ],
                [
                    'label'           => __("Total Earning"),
                    'data'            => [],
                    'backgroundColor' => '#F06292',
                    'stack'           => 'group-extra',
                ]
            ]
        ];

        $to = strtotime($to);
        $from = strtotime($from);

        $sql_raw[] = 'sum(`subtotal` - `discount_amount`) as total_price';
        $sql_raw[] = 'sum( `subtotal` - `discount_amount` - `commission_amount` ) AS total_earning';
        if (($to - $from) / DAY_IN_SECONDS > 90) {
            $year = date("Y", $from);
            // Report By Month
            for ($month = 1; $month <= 12; $month++) {
                $day_last_month = date("t", strtotime($year . "-" . $month . "-01"));
                $sum = OrderItem::selectRaw(implode(",", $sql_raw))->whereBetween('created_at', [
                    $year . '-' . $month . '-01 00:00:00',
                    $year . '-' . $month . '-' . $day_last_month . ' 23:59:59'
                ])
                    ->where('vendor_id',auth()->id())
                    ->whereIn('status',[Order::COMPLETED])->first();
                $data['labels'][] = date("F", strtotime($year . "-" . $month . "-01"));
                $data['datasets'][0]['data'][] = $sum->total_price ?? 0;
                $data['datasets'][1]['data'][] = $sum->total_earning ?? 0;
            }
        } elseif (($to - $from) <= DAY_IN_SECONDS) {
            // Report By Hours
            for ($i = strtotime(date('Y-m-d', $from)); $i <= strtotime(date('Y-m-d 23:59:59', $to)); $i += HOUR_IN_SECONDS) {
                $sum = OrderItem::selectRaw(implode(",", $sql_raw))->whereBetween('created_at', [
                    date('Y-m-d H:i:s', $i),
                    date('Y-m-d H:i:s', $i + HOUR_IN_SECONDS - 1),
                ])->where('vendor_id',auth()->id())
                    ->whereIn('status',[Order::COMPLETED])->first();
                $data['labels'][] = date('H:i', $i);
                $data['datasets'][0]['data'][] = $sum->total_price ?? 0;
                $data['datasets'][1]['data'][] = $sum->total_earning ?? 0;
            }
        } else {
            // Report By Day
            for ($i = strtotime(date('Y-m-d', $from)); $i <= strtotime(date('Y-m-d 23:59:59', $to)); $i += DAY_IN_SECONDS) {
                $sum = OrderItem::selectRaw(implode(",", $sql_raw))->whereBetween('created_at', [
                    date('Y-m-d 00:00:00', $i),
                    date('Y-m-d 23:59:59', $i),
                ])->where('vendor_id',auth()->id())
                    ->whereIn('status',[Order::COMPLETED])->first();
                $data['labels'][] = display_date($i);
                $data['datasets'][0]['data'][] = $sum->total_price ?? 0;
                $data['datasets'][1]['data'][] = $sum->total_earning ?? 0;
            }
        }
        return $data;
    }
}
