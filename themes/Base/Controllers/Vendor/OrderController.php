<?php

namespace Themes\Base\Controllers\Vendor;

use Illuminate\Http\Request;
use Modules\Order\Models\Order;
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
            'rows'=>$orders->with(['product','order'])->paginate(20),
            'page_title'=>__("Order Management")
        ];
        return view('vendor.order.index',$data);
    }

    public function bulkEdit(Request $request)
    {
        $request->validate([
            'ids'=>'required|array',
            'action'=>'required'
        ]);

        $ids = $request->input('ids',[]);
        $action  = $request->input('action');

        foreach ($ids as $id){
            /**
             * @var OrderItem $order
             */
            $order = OrderItem::query()->where('vendor_id',auth()->id())->whereId($id)->first();
            if($order){
                if(!in_array($action,$order->getEditableStatues())){
                    return back()->with('warning',__("Editable status for order: #:id are :list",['id'=>$order->id,'list'=>implode(', ',$order->getEditableStatues())]));
                }
                $order->updateStatus($action);
            }
        }

        return back()->with('success',__("Data saved"));
    }
}
