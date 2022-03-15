<?php


    namespace Themes\Base\Controllers\Order;


    use App\Currency;
    use App\Helpers\ReCaptchaEngine;
    use App\User;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
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
            $data = [
                'items'=>CartManager::items(),
                'page_title'=>__("Checkout"),
                'hide_newsletter'=>true,
                'gateways'=>get_active_payment_gateways(),
                'user'=>$user,
                'billing'=>$user->billing_address ?? new UserAddress(),
                'shipping'=>$user->shipping_address ?? new UserAddress(),
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
            $payment_gateway = $request->input('payment_gateway');
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
            $shipping_country = $request->input('billing_country');
            $rules = [
                'billing_first_name'      => 'required|string|max:255',
                'billing_last_name'       => 'required|string|max:255',
                'billing_email'           => 'required|email|max:255',
                'billing_phone'           => 'required|string|max:255',
                'billing_country' => 'required',
                'billing_address' => 'required',
            ];
            if(!$request->input('shipping_same_address')){
                $rules = array_merge($rules,[
                    'shipping_first_name'      => 'required|string|max:255',
                    'shipping_last_name'       => 'required|string|max:255',
                    'shipping_email'           => 'required|email|max:255',
                    'shipping_phone'           => 'required|string|max:255',
                    'shipping_country' => 'required',
                    'shipping_address' => 'required',
                ]);
                $shipping_country = $request->input('shipping_country');
            }
            $rules['payment_gateway'] = 'required';
            $rules['term_conditions'] = 'required';

            $messages = [
                'term_conditions.required'    => __('Please read and accept Term conditions'),
                'payment_gateway.required' => __('Please select Payment gateway'),
            ];
            $validator = Validator::make($request->all(), $rules , $messages );
            if ($validator->fails()) {
                return $this->sendError('', ['errors' => $validator->errors()]);
            }
            // Validate again before checkout
            try{
                CartManager::validate();
            }catch (\Exception $exception){
                return $this->sendError($exception->getMessage());
            }

            // CartManager add shipping
            if($res = CartManager::addShipping( $shipping_country ,$request->input("shipping_method_id"))){
                if($res['status'] == 0){
                    return $this->sendError($res['message']);
                }
            }

            // Create order and on-hold order
            $order = CartManager::order();

            $order->gateway = $payment_gateway;
            $billing_data = [
                'email'=>$request->input('billing_email'),
                'first_name'=>$request->input('billing_first_name'),
                'last_name'=>$request->input('billing_last_name'),
                'phone'=>$request->input('billing_phone'),
                'country'=>$request->input('billing_country'),
                'address'=>$request->input('billing_address'),
                'address2'=>$request->input('billing_address2'),
                'state'=>$request->input('billing_state'),
                'city'=>$request->input('billing_city'),
                'postcode'=>$request->input('billing_postcode'),
                'company'=>$request->input('billing_company'),
            ];
            $billing_data['email'] = trim(strtolower($billing_data['email']));
            if($request->input('shipping_same_address')){
                $shipping_data = $billing_data;
            }else{
                $shipping_data = [
                    'email'=>$request->input('shipping_email'),
                    'first_name'=>$request->input('shipping_first_name'),
                    'last_name'=>$request->input('shipping_last_name'),
                    'phone'=>$request->input('shipping_phone'),
                    'country'=>$request->input('shipping_country'),
                    'address'=>$request->input('shipping_address'),
                    'address2'=>$request->input('shipping_address2'),
                    'state'=>$request->input('shipping_state'),
                    'city'=>$request->input('shipping_city'),
                    'postcode'=>$request->input('shipping_postcode'),
                    'company'=>$request->input('shipping_company'),
                ];
            }

            $gateways = get_active_payment_gateways();
            if (!empty($rules['payment_gateway'])) {
                if (empty($gateways[$payment_gateway])) {
                    return $this->sendError(__("Payment gateway not found"));
                }
                $gatewayObj = $gateways[$payment_gateway];
                if (!$gatewayObj->isAvailable()) {
                    return $this->sendError(__("Payment gateway is not available"));
                }
            }

            $order->addMeta('locale',app()->getLocale());
            $order->email = $billing_data['email'];
            $order->phone = $billing_data['phone'];
            $order->first_name = $billing_data['first_name'];
            $order->last_name = $billing_data['last_name'];

            $payment = new Payment();
            $payment->object_id = $order->id;
            $payment->object_model = 'order';
            $payment->amount = $order->total;
            $payment->currency = Currency::getCurrent();
            $payment->gateway = $payment_gateway;
            $payment->save();

            $order->payment_id = $payment->id;

            if($user) {
                //update or create user billing
                $user->billing_address()->updateOrCreate([], $billing_data);
                $user->shipping_address()->updateOrCreate([], $shipping_data);
            }else{
                $user = $this->tryCreateUser($billing_data);
            }
            $order->customer_id = $user->id;
            $order->save();

            // save billing order
            $order->addMeta('billing',$billing_data);
            $order->addMeta('shipping',$shipping_data);
            $order->addMeta('shipping_method',CartManager::$_shipping_method);
            try {
                $res = $gatewayObj->process($payment);

                CartManager::clear();
                CartManager::clearCoupon();
                if ($res !== true) {
                    return response()->json($res);
                }
                if(is_array($res)){
                    if(!empty($res['url'])){
                        return $this->sendSuccess([
                            'url' => $res['url']
                        ]);
                    }
                }
                return $this->sendSuccess([
                    'url' => $order->getDetailUrl()
                ]);

            }catch (\Throwable $throwable){
                Log::error("Checkout: ". $throwable->getMessage());
                return $this->sendError($throwable->getMessage(),[
                    'url' => $order->getDetailUrl()
                ]);
            }
        }

        protected function tryCreateUser($billing_data){
            $user = User::query()->where('email',$billing_data['email'])->first();
            if($user){
                return $user;
            }
            $data = [
                'first_name'=>$billing_data['first_name'],
                'last_name'=>$billing_data['last_name'],
                'phone'=>$billing_data['phone'],
                'email'=>$billing_data['email'],
                'status'=>'publish'
            ];
            $user = new User();
            $user->fillByAttr(array_keys($data),$data);
            if(!setting_item('enable_email_verification')){
                $user->email_verified_at = Carbon::now();
            }
            $user->save();
            return $user;
        }
    }
