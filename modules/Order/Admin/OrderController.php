<?php


namespace Modules\Order\Admin;


use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Order\Models\Order;

class OrderController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('order');
    }

    public function index(){
        $this->checkPermission('order_view');
        $data = [
            'rows'=>Order::query()->with('items.model.author')->orderBy('id','desc')->paginate(20),
            'page_title'=>__("Manage Orders"),
        ];
        return view('Order::admin.order.index',$data);
    }

    public function create(Request $request){
        $this->checkPermission('order_create');
        $data = [
            'order'=>new Order(),
            'page_title'=>__("Create Order"),
            'statues'=>app()->make(Order::class)->statues()
        ];
        return view('Order::admin.order.detail',$data);
    }

    public function edit(Request $request,Order $order){
        $this->checkPermission('order_view');
        $data = [
            'order'=>$order,
            'page_title'=>__("Edit Order"),
            'statues'=>app()->make(Order::class)->statues()
        ];
        return view('Order::admin.order.detail',$data);
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

    public function store(Request $request,Order $order = null){

        $request->validate([

        ]);
    }
}
