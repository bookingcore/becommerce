<?php

namespace Themes\Base\Controllers\Vendor;

use Illuminate\Http\Request;
use Modules\Order\Models\OrderItem;
use Modules\Vendor\VendorMenuManager;
use Themes\Base\Controllers\FrontendController;

class OrderController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        VendorMenuManager::setActive('order');
    }

    public function index(Request $request){
        $orders = OrderItem::search([
            'vendor_id'=>auth()->id()
        ])->orderByDesc('id');
        $data = [
            'rows'=>$orders->paginate(20),
            'page_title'=>__("Order Management")
        ];
        return view('vendor.order.index',$data);
    }
}
