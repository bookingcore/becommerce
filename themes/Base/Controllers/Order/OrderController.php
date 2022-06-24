<?php


namespace Themes\Base\Controllers\Order;


use Illuminate\Http\Request;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Themes\Base\Controllers\FrontendController;

class OrderController extends FrontendController
{
    public function detail($code){
        $order = Order::where('code',$code)->first();
        if(!$order){
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
            'page_title'=>__("Thank you for your order")
        ];
        return view('order.detail',$data);
    }

    public function confirmPayment(Request $request, $gateway)
    {
        $gateways = get_active_payment_gateways();
        if (empty($gateways[$gateway])) {
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
        if (empty($gateways[$gateway])) {
            $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->cancelPayment($request);
    }

    public function modal($code){
        $order = Order::whereCode($code)->first();
        if(!$order){
            abort(404);
        }
        if(!is_admin() and $order->customer_id != auth()->id()){
            abort(404);
        }
        return view('order.detail.modal',['order'=>$order]);
    }
}
