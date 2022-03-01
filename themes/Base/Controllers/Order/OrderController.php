<?php


namespace Themes\Base\Controllers\Order;


use Illuminate\Http\Request;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Themes\Base\Controllers\FrontendController;

class OrderController extends FrontendController
{
    public function detail($id){
        $order = Order::find($id);
        if(!$order or $order->customer_id != auth()->id()){
            abort(404);
        }

        $data = [
            'row'=>$order,
            'hide_newsletter'=>true,
            'breadcrumbs'=>[
                [
                    'name'=> "Order Detail",
                ]
            ],
        ];
        return view('order.detail',$data);
    }

    public function confirmPayment(Request $request, $gateway)
    {
        $gateways = get_active_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->confirmPayment($request);
    }

    public function cancelPayment(Request $request, $gateway)
    {
        $gateways = get_active_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->cancelPayment($request);
    }
    public function history(Request $request)
    {

        $data = [
            'page'=>__('Order History'),
            'rows'=>OrderItem::query()->with(['order'])->paginate(20)
        ];

        return view('Order::frontend.user.history',$data);
    }

}
