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
    use Modules\Order\Gateways\BaseGateway;
    use Modules\Order\Helpers\CartManager;
    use Modules\Order\Models\Cart;
    use Modules\Order\Models\Order;
    use Modules\Order\Models\Payment;
    use Modules\Product\Models\UserAddress;
    use Themes\Base\Controllers\FrontendController;
    class CheckoutController extends FrontendController
    {
        public function __construct(CartManager $cart_manager)
        {
            parent::__construct();
            $this->cart_manager = $cart_manager;
        }
        public function toCheckout(){
            $cart = $this->cart_manager::cart();
            if($cart)
            {
                return redirect(route('checkout.detail',['code'=>$cart->code]));
            }

            return redirect('cart');
        }

        public function index($code){
            /**
             * @var Cart $cart
             */
            $cart = Cart::findByCode($code);
            if(!$cart){
                return redirect('cart');
            }

            if(!$cart->needCheckout()){
                $this->cart_manager::clear();
                return redirect($cart->getDetailUrl());
            }

            if(!is_enable_guest_checkout() and !Auth::check()){
                return redirect(route('login',['redirect'=>'/checkout']))->with('warning',__("Please login to continue"));
            }

            if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_email_verification')){
                return redirect(route('email/verify'))->with('warning',__("You have to verify email first"));
            }

            $user = Auth::user();
            $data = [
                'items'=>$cart->items,
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
                'cart'=>$cart
            ];
            return view('order.checkout.index',$data);
        }

        public function process(Request $request,$code){

            /**
             * @var Cart $cart
             * @var Order $order
             */

            $cart = Cart::findByCode($code);
            if(!$cart){
                return $this->sendError(__("Cart does not exists"),['code'=>'cart_not_found']);
            }

            $validate = $this->checkoutValidate($request,$cart);

            if($validate !== true ) return $validate;

            /**
             * @var User $user
             */
            $payment_gateway = $request->input('payment_gateway');

            if($cart->needPayment()) {
                $gateways = get_active_payment_gateways();
                if (empty($gateways[$payment_gateway])) {
                    return $this->sendError(__("Payment gateway not found"));
                }
                $gatewayObj = $gateways[$payment_gateway];
                if (!$gatewayObj->isAvailable()) {
                    return $this->sendError(__("Payment gateway is not available"));
                }
            }

            // Create order
            try {

                $order = $cart->prepareCheckout($request);

                $this->processAddress($request,$order);

                if(!$order->needPayment()){

                    $this->cart_manager::clear();

                    $order->updateStatus($order::PROCESSING);

                    return $this->sendSuccess([
                        'url' => $order->getDetailUrl()
                    ]);

                }


                return $this->processOrderPayment($order,$gatewayObj);

            }catch (\Throwable $throwable){
                report($throwable);
                return $this->sendError($throwable->getMessage());
            }
        }

        public function processAddress(Request $request,Order $order)
        {
            /**
             * @var User $user
             */
            $user = \auth()->user();

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

            $order->email = $billing_data['email'];
            $order->phone = $billing_data['phone'];
            $order->first_name = $billing_data['first_name'];
            $order->last_name = $billing_data['last_name'];

            if($user) {
                $user->save_default_address($billing_data,UserAddress::BILLING);
                $user->save_default_address($shipping_data,UserAddress::SHIPPING);
            }else{
                $user = $this->tryCreateUser($billing_data,$shipping_data);
            }
            $order->customer_id = $user->id;
            $order->save();

            // save billing order
            $order->addMeta('billing',$billing_data);
            $order->addMeta('shipping',$shipping_data);
            $order->addMeta('shipping_method',$this->cart_manager::cart()->shipping_method);
            $order->addMeta('need_shipping',$order->needShipping());
        }

        public function processOrderPayment(Order $order,BaseGateway $gatewayObj){

            $res = $gatewayObj->process($order);

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

            $this->cart_manager::clear();

            return $this->sendSuccess([
                'url' => $order->getDetailUrl()
            ]);
        }

        protected function checkoutValidate(Request $request,Cart $cart){

            if(!is_enable_guest_checkout() and !Auth::check()){
                return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
            }

            if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_email_verification')){
                return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
            }
            /**
             * @var User $user
             */
            $items = $cart->items;
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
                'billing_first_name' => 'required|string|max:255',
                'billing_last_name'  => 'required|string|max:255',
                'billing_email'      => 'required|email|max:255',
                'billing_phone'      => 'required|string|max:255',
                'billing_city'       => 'required',
                'billing_country'    => 'required',
                'billing_address'    => 'required',
            ];
            if (!$request->input('shipping_same_address') and $cart->needShipping()) {
                $rules = array_merge($rules, [
                    'shipping_first_name' => 'required|string|max:255',
                    'shipping_last_name'  => 'required|string|max:255',
                    'shipping_email'      => 'required|email|max:255',
                    'shipping_phone'      => 'required|string|max:255',
                    'shipping_city'       => 'required',
                    'shipping_country'    => 'required',
                    'shipping_address'    => 'required',
                ]);
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
                $cart->validate();
            }catch (\Exception $exception){
                return $this->sendError($exception->getMessage());
            }

            return true;
        }

        protected function tryCreateUser($billing_data,$shipping_data){
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
            $user->save_default_address($billing_data,UserAddress::BILLING);
            $user->save_default_address($shipping_data,UserAddress::SHIPPING);
            return $user;
        }
    }
