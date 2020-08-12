<?php
namespace Modules\Booking\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Product\Models\Order;
use Modules\Product\Models\OrderItem;

class OrderController extends AdminController
{
    public function index(){
        $this->checkPermission('report_view');

        $data = [
            'rows'=>Order::query()->orderBy('id','desc')->paginate(20)
        ];
        return view('Booking::admin.orders.index',$data);
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }

        switch ($action){
            case "delete":
                foreach ($ids as $id) {
                    $query = Order::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('product_delete');
                    }
                    $query->first()->delete();
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
        }
    }
}
