<?php


    namespace Themes\Base\Controllers\Order;


    use App\Currency;
    use App\Helpers\ReCaptchaEngine;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Modules\Coupon\Models\CouponOrder;
    use Modules\Order\Events\OrderUpdated;
    use Modules\Order\Helpers\CartManager;
    use Modules\Order\Models\Order;
    use Modules\Order\Models\Payment;
    use Modules\Product\Models\UserAddress;
    use Themes\Base\Controllers\FrontendController;
    class CheckoutController extends FrontendController
    {
        public function index(){
            $user = Auth::user();
            $billing  = $user->billing_address;
            if(empty($billing)){
                $billing = new UserAddress();
            }
            $data = [
                'items'=>CartManager::items(),
                'page_title'=>__("Checkout"),
                'hide_newsletter'=>true,
                'gateways'=>get_payment_gateway_objects(),
                'user'=>$user,
                'billing'=>$billing,
                'breadcrumbs'=>[
                    [
                        'name'=> "Checkout",
                    ]
                ],
            ];
            return view('order.checkout.index',$data);
        }

        public function process(Request $request){

            $user = auth()->user();
            $items = CartManager::items();
            if(empty($items)){
                return $this->sendError(__("Your cart is empty"));
            }

            /**
             * Google ReCapcha
             */
            if(ReCaptchaEngine::isEnable() and setting_item("order_enable_recaptcha")){
                $codeCapcha = $request->input('g-recaptcha-response');
                if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                    return $this->sendError(__("Please verify the captcha"));
                }
            }

            $rules = [
                'first_name'      => 'required|string|max:255',
                'last_name'       => 'required|string|max:255',
                'phone'           => 'required|string|max:255',
                'country' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'payment_gateway' => 'required',
                'term_conditions' => 'required',
            ];
            $payment_gateway = $request->input('payment_gateway');

            $messages = [
                'term_conditions.required'    => __('Please read and accept Term conditions'),
                'payment_gateway.required' => __('Please select Payment gateway'),
            ];
            $validator = Validator::make($request->all(), $rules , $messages );
            if ($validator->fails()) {
                return $this->sendError('', ['errors' => $validator->errors()]);
            }

//            Create order and on-hold order
            $order = CartManager::order();


            $order->gateway = $payment_gateway;
            $billing_data = [
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'phone'=>$request->input('phone'),
                'country'=>$request->input('country'),
                'address'=>$request->input('address'),
                'address2'=>$request->input('address2'),
                'state'=>$request->input('state'),
                'city'=>$request->input('city'),
                'zip_code'=>$request->input('zip_code'),
            ];

            $gateways = get_payment_gateways();
            $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);
            if (!empty($rules['payment_gateway'])) {
                if (empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway])) {
                    return $this->sendError(__("Payment gateway not found"));
                }
                if (!$gatewayObj->isAvailable()) {
                    return $this->sendError(__("Payment gateway is not available"));
                }
            }

            $order->addMeta('locale',app()->getLocale());

            $payment = new Payment();
            $payment->object_id = $order->id;
            $payment->object_model = 'order';
            $payment->amount = $order->total;
            $payment->currency = Currency::getCurrent();
            $payment->gateway = $payment_gateway;
            $payment->save();

            $order->payment_id = $payment->id;
            $order->save();

            //            save billing order
            $order->addMeta('billing',$billing_data);
            if(!empty($request->input('billing_id'))){
                $billing_data['id'] = $request->input('billing_id');
            }
            //update or create user billing
            $user->billing_address()->updateOrCreate([],$billing_data);
            try {
                $res = $gatewayObj->process($payment);

                CartManager::clear();
                CartManager::clearCoupon();

                if ($res !== true) {
                    return response()->json($res);
                }
                if(is_array($res)){
                    list($status,$messages,$redirect) = $res;
                    if(!empty($redirect)){
                        return $this->sendSuccess([
                            'url' => $order->getDetailUrl()
                        ]);
                    }
                }
                return $this->sendSuccess([
                    'url' => $order->getDetailUrl()
                ]);

            }catch (\Throwable $throwable){
                return $this->sendError($throwable->getMessage());
            }
        }
    }
