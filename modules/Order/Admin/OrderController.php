<?php


namespace Modules\Order\Admin;


use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Order\Models\Order;
use Modules\Order\Rules\ValidOrderItems;

class OrderController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('order');
    }

    public function index(Request $request){
        $this->checkPermission('order_view');
        $query = Order::query();
        if (!empty($request->input('s'))) {
            if( is_numeric($request->input('s')) ){
                $query->Where('id', '=', $request->input('s'));
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->input('s') . '%')
                        ->orWhere('last_name', 'like', '%' . $request->input('s') . '%')
                        ->orWhere('email', 'like', '%' . $request->input('s') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('s') . '%');
                });
            }
        }
        $data = [
            'rows'=>$query->with('items.product.author')->orderBy('id','desc')->paginate(20),
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
            'status'=>'required',
            'items.*.product_id'=>'required',
            'items.*.qty'=>'required|integer|gte:1',
            'items'=>['required',new ValidOrderItems()]
        ]);

        if(!$order){
            $order = new Order();
        }

        $data = [
            'customer_id'=>$request->input('customer_id'),
            'status'=>$request->input('status'),
            'order_date'=>$request->input('order_date'),
            'shipping_amount'=>$request->input('shipping_amount'),
        ];

        $order->fillByAttr(array_keys($data),$data);
        $order->save();

        $metas = [
            'billing'=>$request->input('billing'),
            'shipping'=>$request->input('shipping'),
            'shipping_method'=>$request->input('shipping_method'),
        ];
        foreach ($metas as $k=>$meta){
            $order->addMeta($k,$meta);
        }

        $order->saveItems($request->input('items'));
        $order->saveTax($request->input('tax_lists'));

        return $this->sendSuccess(__("Order saved"));
    }
}
