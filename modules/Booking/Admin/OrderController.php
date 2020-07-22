<?php
namespace Modules\Booking\Admin;

use Modules\AdminController;

class OrderController extends AdminController
{
    public function index(){
        $this->checkPermission('report_view');

        $data = [
            'rows'=>\Modules\Product\Models\Order::query()->paginate(20)
        ];
        return view('Booking::admin.orders.index',$data);
    }
}
