<?php
namespace Modules\Report\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Report\Exports\ProductExport;

class ReportController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('report');
    }

    public function overview(Request $request){

        $this->checkPermission('report_view');
        $order = new Order();
        $chart_data = [
            'labels'   => [],
            'datasets' => [
                [
                    'label'           => __("Gross sales"),
                    'data'            => [],
                    'borderColor' => '#b1d4ea',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Net sales"),
                    'data'            => [],
                    'borderColor' => '#3498db',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Orders placed"),
                    'data'            => [],
                    'backgroundColor' => '#dbe1e3',
                    'yAxisID' => 'y-axis-2',
                ],
                [
                    'label'           => __("Items purchased"),
                    'data'            => [],
                    'backgroundColor' => '#ecf0f1',
                    'yAxisID' => 'y-axis-2',
                ],
                [
                    'label'           => __("Charged for shipping"),
                    'data'            => [],
                    'borderColor' => '#5cc488',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Worth of coupons used"),
                    'data'            => [],
                    'borderColor' => '#f1c40f',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ]
            ]
        ];
        $range = $request->get('range', 'last7days');
        $topProductQuery = OrderItem::select("*",\DB::raw('sum(qty) as number'),\DB::raw('sum(subtotal) as gross_sales'))->where('status',Order::COMPLETED);
        switch ($range){
            case 'year';
                $year = date("Y");
                $topProductQuery->whereYear('order_date',$year);
                for ($month = 1; $month <= 12; $month++){
                    $m = date('F', strtotime($year . "-" . $month . "-01"));
                    $chart_data['labels'][] = $m;
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', strtotime($year . "-" . $month . "-01 ")), date('Y-m-d 23:59:59', strtotime('last day of '.$m, time())));
                    report_set_data_chart($chart_data, $report_data);

                }
                break;
            case 'last-month';
                $last_month = Date("m", strtotime("first day of previous month"));
                $topProductQuery->whereMonth('order_date',$last_month);
                $m = Date("F", strtotime("first day of previous month"));
                for ($i = strtotime(date('Y-'.$last_month.'-01 00:00:00')); $i <= strtotime('last day of '.$m, time()); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'this-month';
                $topProductQuery->whereMonth('order_date',date('m'));
                for ($i = strtotime(date('Y-m-01')); $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'custom';
                $from = $request->get('from', date('Y-m-0'));
                $to = $request->get('to', date('Y-m-d'));
                $topProductQuery->whereBetween('order_date',[$from.' 00:00:00',$to.' 23:59:59']);

                for ($i = strtotime($from); $i <= strtotime($to); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
                break;
            default;
                $topProductQuery->whereBetween('order_date',[Carbon::now()->subDays(7),Carbon::now()]);
                for ($i = strtotime('-7 days') + DAY_IN_SECONDS; $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
        }


        $data_total = [
            'gloss_sales' => array_sum($chart_data['datasets'][0]['data']),
            'net_sales' => array_sum($chart_data['datasets'][1]['data']),
            'orders_placed' => array_sum($chart_data['datasets'][2]['data']),
            'items_purchased' => array_sum($chart_data['datasets'][3]['data']),
            'total_shipping' => array_sum($chart_data['datasets'][4]['data']),
            'coupons_used' => array_sum($chart_data['datasets'][5]['data'])
        ];
        $topSold = $topProductQuery->groupBy('object_id')->latest('qty')->with('product')->get();

        $data = [
            'report_chart_data' => $chart_data,
            'data_total' => $data_total,
            'topSold' => $topSold,
            'breadcrumbs'        => [
                [
                    'name'  => __('Overview'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Report::admin.overview', $data);
    }

    public function products(Request $request){

        $this->checkPermission('report_view');
        $order = new Order();

        $chart_data = [
            'labels'   => [],
            'datasets' => [
                [
                    'label'           => __("Gross sales"),
                    'data'            => [],
                    'borderColor' => '#b1d4ea',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Net sales"),
                    'data'            => [],
                    'borderColor' => '#3498db',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Orders placed"),
                    'data'            => [],
                    'backgroundColor' => '#dbe1e3',
                    'yAxisID' => 'y-axis-2',
                ],
                [
                    'label'           => __("Items purchased"),
                    'data'            => [],
                    'backgroundColor' => '#ecf0f1',
                    'yAxisID' => 'y-axis-2',
                ],
                [
                    'label'           => __("Charged for shipping"),
                    'data'            => [],
                    'borderColor' => '#5cc488',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Worth of coupons used"),
                    'data'            => [],
                    'borderColor' => '#f1c40f',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ]
            ]
        ];
        $range = $request->get('range', 'last7days');
        switch ($range){
            case 'year';
                $year = date("Y");
                for ($month = 1; $month <= 12; $month++){
                    $m = date('F', strtotime($year . "-" . $month . "-01"));
                    $chart_data['labels'][] = $m;
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', strtotime($year . "-" . $month . "-01 ")), date('Y-m-d 23:59:59', strtotime('last day of '.$m, time())));
                    report_set_data_chart($chart_data, $report_data);

                }
            break;
            case 'last-month';
                $last_month = Date("m", strtotime("first day of previous month"));
                $m = Date("F", strtotime("first day of previous month"));
                for ($i = strtotime(date('Y-'.$last_month.'-01 00:00:00')); $i <= strtotime('last day of '.$m, time()); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'this-month';
                for ($i = strtotime(date('Y-m-01')); $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'custom';
                $from = $request->get('from', date('Y-m-0'));
                $to = $request->get('to', date('Y-m-d'));

                for ($i = strtotime($from); $i <= strtotime($to); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            default;
                for ($i = strtotime('-7 days') + DAY_IN_SECONDS; $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
        }

        $data_total = [
            'gloss_sales' => array_sum($chart_data['datasets'][0]['data']),
            'net_sales' => array_sum($chart_data['datasets'][1]['data']),
            'orders_placed' => array_sum($chart_data['datasets'][2]['data']),
            'items_purchased' => array_sum($chart_data['datasets'][3]['data']),
            'total_shipping' => array_sum($chart_data['datasets'][4]['data']),
            'coupons_used' => array_sum($chart_data['datasets'][5]['data'])
        ];
        $listProduct = $this->_productReport($request)->paginate(12);
        $data = [
            'report_chart_data' => $chart_data,
            'data_total' => $data_total,
            'listProduct' => $listProduct,
            'breadcrumbs'        => [
                [
                    'name'  => __('Products'),
                    'class' => 'active'
                ],
            ],
        ];

        return view('Report::admin.products', $data);
    }

    public function productExport(Request $request)
    {
        $this->checkPermission('report_view');
        $listProduct = $this->_productReport($request)->get();
        return (new ProductExport($listProduct))->download('report-product-export-' . date('M-d-Y') . '.xlsx');
    }
    public function revenueExport(Request $request)
    {
        $this->checkPermission('report_view');
        $listProduct = $this->_productReport($request)->get();
        return (new ProductExport($listProduct))->download('report-product-export-' . date('M-d-Y') . '.xlsx');
    }

    public function revenue(Request $request){

        $this->checkPermission('report_view');
        $order = new Order();
        $chart_data = [
            'labels'   => [],
            'datasets' => [
                [
                    'label'           => __("Gross sales"),
                    'data'            => [],
                    'borderColor' => '#b1d4ea',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Net sales"),
                    'data'            => [],
                    'borderColor' => '#3498db',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Orders placed"),
                    'data'            => [],
                    'backgroundColor' => '#dbe1e3',
                    'yAxisID' => 'y-axis-2',
                ],
                [
                    'label'           => __("Items purchased"),
                    'data'            => [],
                    'backgroundColor' => '#ecf0f1',
                    'yAxisID' => 'y-axis-2',
                ],
                [
                    'label'           => __("Charged for shipping"),
                    'data'            => [],
                    'borderColor' => '#5cc488',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ],
                [
                    'label'           => __("Worth of coupons used"),
                    'data'            => [],
                    'borderColor' => '#f1c40f',
                    'backgroundColor' => 'transparent',
                    'type' => 'line',
                    'yAxisID' => 'y-axis-1',
                ]
            ]
        ];
        $range = $request->get('range', 'last7days');
        $tableQuery = Order::select([
            \DB::raw('sum(subtotal) as gross_sales'),
            \DB::raw('sum(total) as net_sales'),
            \DB::raw('sum(tax_amount) as tax_amount'),
            \DB::raw('sum(shipping_amount) as shipping_amount'),
            \DB::raw('sum(discount_amount) as discount_amount'),
            \DB::raw('DATE_FORMAT(order_date,"%Y-%m-%d") as order_date_format'),
            \DB::raw('DATE_FORMAT(order_date,"%Y-%m") as order_month_format'),
            \DB::raw('DATE_FORMAT(order_date,"%Y") as order_year_format'),
        ])->where('status',Order::COMPLETED);

        switch ($range){
            case 'year';
                $year = date("Y");
                $tableQuery->whereYear('order_date',$year);
                for ($month = 1; $month <= 12; $month++){
                    $m = date('F', strtotime($year . "-" . $month . "-01"));
                    $chart_data['labels'][] = $m;
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', strtotime($year . "-" . $month . "-01 ")), date('Y-m-d 23:59:59', strtotime('last day of '.$m, time())));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'last-month';
                $last_month = Date("m", strtotime("first day of previous month"));
                $m = Date("F", strtotime("first day of previous month"));
                for ($i = strtotime(date('Y-'.$last_month.'-01 00:00:00')); $i <= strtotime('last day of '.$m, time()); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'this-month';
                for ($i = strtotime(date('Y-m-01')); $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            case 'custom';
                $from = $request->get('from', date('Y-m-0'));
                $to = $request->get('to', date('Y-m-d'));
                for ($i = strtotime($from); $i <= strtotime($to); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            default;
                for ($i = strtotime('-7 days') + DAY_IN_SECONDS; $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
        }

        $data_total = [
            'gloss_sales' => array_sum($chart_data['datasets'][0]['data']),
            'net_sales' => array_sum($chart_data['datasets'][1]['data']),
            'orders_placed' => array_sum($chart_data['datasets'][2]['data']),
            'items_purchased' => array_sum($chart_data['datasets'][3]['data']),
            'total_shipping' => array_sum($chart_data['datasets'][4]['data']),
            'coupons_used' => array_sum($chart_data['datasets'][5]['data'])
        ];
        $rows = collect();

        switch ($range){
            case 'year';
                $year = date("Y");
                $currentMonth = date("m");
                $tableQueryResult =  $tableQuery->groupBy('order_month_format')->orderBy('order_month_format','desc')->get();
                for ($month = 1; $month <= $currentMonth; $month++){
                    $m = date('Y-m', strtotime($year . "-" . $month));
                    $row = $tableQueryResult->where('order_month_format',$m)->first();
                    if(!$row){
                        $row = new \stdClass();
                        $row->order_month_format = $m;
                    }
                    $rows->prepend($row);
                }
            break;
            case 'last-month';
                $last_month = Date("m", strtotime("first day of previous month"));
                $tableQueryResult  = $tableQuery->whereMonth('order_date',$last_month)
                    ->groupBy('order_date_format')
                    ->orderBy('order_date_format','desc')
                    ->get();
                $m = Date("F", strtotime("first day of previous month"));
                for ($i = strtotime(date('Y-'.$last_month.'-01 00:00:00')); $i <= strtotime('last day of '.$m, time()); $i += DAY_IN_SECONDS ){
                    $row = $tableQueryResult->where('order_date_format',date('Y-m-d',$i))->first();
                    if(!$row){
                        $row = new \stdClass();
                        $row->order_date_format = date('Y-m-d', $i);
                    }
                    $rows->prepend($row);
                }
            break;
            case 'this-month';
                $tableQueryResult = $tableQuery->whereMonth('order_date',date('m'))
                    ->groupBy('order_date_format')
                    ->orderBy('order_date_format','desc')
                    ->get();
                for ($i = strtotime(date('Y-m-01')); $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $row = $tableQueryResult->where('order_date_format',date('Y-m-d',$i))->first();
                    if(!$row){
                        $row = new \stdClass();
                        $row->order_date_format = date('Y-m-d', $i);
                    }
                    $rows->prepend($row);
                }
            break;
            case 'custom';
                $from = $request->get('from', date('Y-m-0'));
                $to = $request->get('to', date('Y-m-d'));
                $tableQuery->whereBetween('order_date',[$from.' 00:00:00',$to.' 23:59:59']);
                for ($i = strtotime($from); $i <= strtotime($to); $i += DAY_IN_SECONDS ){
                    $chart_data['labels'][] = date('d M', $i);
                    $report_data = $order->getOrderReportData(date('Y-m-d 00:00:00', $i), date('Y-m-d 23:59:59', $i));
                    report_set_data_chart($chart_data, $report_data);
                }
            break;
            default;
               $tableQueryResult = $tableQuery->whereBetween('order_date',[Carbon::now()->subDays(7),Carbon::now()])
                    ->groupBy('order_date_format')
                    ->orderBy('order_date_format','desc')
                    ->get();
                for ($i = strtotime('-7 days') + DAY_IN_SECONDS; $i <= strtotime(date('Y-m-d 23:59:59')); $i += DAY_IN_SECONDS ){
                    $row = $tableQueryResult->where('order_date_format',date('Y-m-d',$i))->first();
                    if(!$row){
                        $row = new \stdClass();
                        $row->order_date_format = date('Y-m-d', $i);
                    }
                    $rows->prepend($row);
                }
            break;
        }
        $data = [
            'report_chart_data' => $chart_data,
            'data_total' => $data_total,
            'rows' => $rows->all(),
            'breadcrumbs'        => [
                [
                    'name'  => __('Revenue'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Report::admin.revenue', $data);
    }

    public function orders(Request $request){

        $this->checkPermission('report_view');

        $data = [
            'breadcrumbs'        => [
                [
                    'name'  => __('Revenue'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Report::admin.orders', $data);
    }












    private function _productReport(Request $request){
        $productTable= Product::getTableName();
        $orderItemTable = OrderItem::getTableName();

        $range = $request->get('range', 'last7days');
        $productQuery = Product::leftJoin($orderItemTable,$productTable.'.id','=',$orderItemTable.'.object_id')
            ->where($orderItemTable.'.status',Order::COMPLETED);

        switch ($range){
            case 'year';
                $year = date("Y");
                $productQuery->whereYear($orderItemTable.'.order_date',$year);

            break;
            case 'last-month';
                $last_month = Date("m", strtotime("first day of previous month"));
                $productQuery->whereMonth($orderItemTable.'.order_date',$last_month);

            break;
            case 'this-month';
                $productQuery->whereMonth($orderItemTable.'.order_date',date('m'));
            break;
            case 'custom';
                $from = $request->get('from', date('Y-m-0'));
                $to = $request->get('to', date('Y-m-d'));
                $productQuery->whereBetween($orderItemTable.'.order_date',[$from.' 00:00:00',$to.' 23:59:59']);
            break;
            default;
                $productQuery->whereBetween($orderItemTable.'.order_date',[Carbon::now()->subDays(7),Carbon::now()]);
            break;
        }
        return $productQuery
            ->select([
                $productTable.'.*',
                $orderItemTable.'.qty',
                \DB::raw('count('.$orderItemTable.'.object_id) as total_sold'),
                \DB::raw('sum('.$orderItemTable.'.subtotal + '.$orderItemTable.'.shipping_amount - '.$orderItemTable.'.discount_amount) as net_sales'),
            ])
            ->groupBy($orderItemTable.'.id')
            ->orderBy($orderItemTable.'.order_date','desc')
            ->where($productTable.'.status','publish')
            ->with('categories');
    }

}
