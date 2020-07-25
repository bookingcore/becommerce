<?php
namespace Modules\Booking\Admin;

use Modules\AdminController;
use Modules\Product\Models\Order;

class OrderController extends AdminController
{
    public function index(){
        $this->checkPermission('report_view');

        $data = [
            'rows'=>Order::query()->paginate(20)
        ];
        dump($data['rows']);
        return view('Booking::admin.orders.index',$data);
    }
}
