<?php
namespace Modules\Report\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;

class ReportController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('report');
    }

    public function overview(Request $request){

        $this->checkPermission('report_view');
        $range = $request->get('range', 'last7days');
        $labels = [];
        switch ($range){
            case 'year';
                $year = date("Y");
                for ($month = 1; $month <= 12; $month++){
                    $labels[] = date('F', strtotime($year . "-" . $month . "-01"));
                }
                break;
            case 'last-month';
                $last_month = Date("m", strtotime("first day of previous month"));
                for ($i = strtotime(date('Y-'.$last_month.'-0')) + DAY_IN_SECONDS; $i <= strtotime(date('Y-'.$last_month.'-t')); $i += DAY_IN_SECONDS ){
                    $labels[] = date('d/m', $i);
                }
            break;
            case 'this-month';
                for ($i = strtotime(date('Y-m-0')) + DAY_IN_SECONDS; $i <= strtotime(date('Y-m-d')); $i += DAY_IN_SECONDS ){
                    $labels[] = date('d/m', $i);
                }
            break;
            default;
                for ($i = strtotime('-7 days') + DAY_IN_SECONDS; $i <= strtotime(date('Y-m-d')); $i += DAY_IN_SECONDS ){
                    $labels[] = date('d/m', $i);
                }
            break;
        }

        $report_chart_data = [
            'labels' => $labels,
            'datasets' => [
                []
            ]
        ];

        $data = [
            'report_chart_data' => $report_chart_data,
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

        $data = [
            'breadcrumbs'        => [
                [
                    'name'  => __('Products'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Report::admin.products', $data);
    }

    public function revenue(Request $request){

        $this->checkPermission('report_view');

        $data = [
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

}
