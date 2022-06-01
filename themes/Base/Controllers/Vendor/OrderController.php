<?php

namespace Themes\Base\Controllers\Vendor;

use Illuminate\Http\Request;
use Modules\Order\Models\OrderItem;
use Modules\Vendor\VendorMenuManager;
use Themes\Base\Controllers\FrontendController;

class OrderController extends FrontendController
{
    protected $orderItem = null;

    public function __construct(OrderItem $orderItem)
    {
        parent::__construct();
        VendorMenuManager::setActive('order');

        $this->orderItem = $orderItem;
    }

    public function index(Request $request){
        $filters = $request->query();
        $filters['vendor_id'] = auth()->id();

        $orders = $this->orderItem::search($filters)->orderByDesc('id');

        $data = [
            'rows'=>$orders->paginate(20),
            'page_title'=>__("Order Management")
        ];
        return view('vendor.order.index',$data);
    }
}
