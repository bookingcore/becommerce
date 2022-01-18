<?php
namespace Modules\Report\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;

class ReportController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/overview');
    }

    public function overview(Request $request){

        $this->checkPermission('report_view');

        $data = [
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
