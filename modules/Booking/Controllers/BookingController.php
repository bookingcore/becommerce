<?php
namespace Modules\Booking\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;
use Gloudemans\Shoppingcart\Facades\Cart;

class BookingController extends \App\Http\Controllers\Controller
{
    use AuthorizesRequests;
    protected $booking;

    public function __construct()
    {
        $this->booking = Booking::class;
    }

    public function checkout()
    {
        $data = [
            'page_title' => __('Checkout'),
            'gateways'   => $this->getGateways(),
            'user'       => Auth::user(),
            'show_breadcrumb'   =>  0,
            'breadcrumbs'=>[
                ['name'=>__("Checkout"),'class'=>'active']
            ]
        ];
        return view('Booking::frontend.checkout', $data);
    }

    public function cart(Request $request)
    {
        $message = [];
        $s_coupon = (!empty(session('coupon'))) ? session('coupon') : [];
        if ($request->isMethod('post')){
            if (!empty($request->input('product'))){
                foreach ($request->input('product') as $k => $val){
                    $rowId = array_keys($val)[0];
                    Cart::update($rowId, $val[$rowId]); // Will update the quantity
                }
                $message = ['class'=>'bravo-message','text'=>__('Cart updated.')];
            }
            if (!empty($request->input('coupon'))){
                $coupon = Coupon::where('name',$request->input('coupon'))->where('status','publish')->first();
                if (!empty($coupon)){
                    $expiration = explode(' - ',$coupon->expiration);
                    $today = date('Y-m-d');
                    $error = false;
                    $allow = true;
                    if (strtotime($today) >= strtotime($expiration[0]) && strtotime($today) <= strtotime($expiration[1])){
                        $get_coupon = [
                            'id'    =>  $coupon->id,
                            'name'  =>  $coupon->name,
                            'type'  =>  $coupon->coupon_type,
                            'discount'=>$coupon->discount,
                            'status'=>  $coupon->status
                        ];
                        if (!empty($s_coupon)){
                            foreach ($s_coupon as $itemCoupon){
                                if ($request->input('coupon') == $itemCoupon['name']) $error = true;
                            }
                        }
                        if ($error == true){
                            $message = ['class'=>'bravo-error','text'=>__('Coupon ":coupon" already applied!',['coupon'=>$request->input('coupon')])];
                        } else {
                            if (!empty($email = json_decode($coupon->email)) || !empty($id = json_decode($coupon->customer_id))){
                                if ( (!empty($email) && !in_array(Auth::user()->email, $email)) || (!empty($id) && !in_array(Auth::id(), $id)) ){
                                    $allow = false;
                                    $message = ['class'=>'bravo-error','text'=>__('Coupon ":coupon" not applied to this Email or Customer!',['coupon'=>$request->input('coupon')])];
                                }
                            }
                            if (!empty($coupon->per_coupon) && $coupon->per_coupon > 0){
                                if ($coupon->usage >= $coupon->per_coupon){
                                    $allow = false;
                                    $message = ['class'=>'bravo-error','text'=>__('Coupon usage limit has been reached.')];
                                }
                            }
                            if ($allow == true){
                                array_push($s_coupon, $get_coupon);
                                $message = ['class'=>'bravo-message','text'=>__('Coupon ":coupon" applied successfully.',['coupon'=>$request->input('coupon')])];
                            }
                        }
                        session(['coupon' => $s_coupon]);
                    } else {
                        $message = ['class'=>'bravo-error','text'=>__('Coupon ":coupon" expiration!',['coupon'=>$request->input('coupon')])];
                    }
                } else {
                    $message = ['class'=>'bravo-error','text'=>__('Coupon ":coupon" does not exist!',['coupon'=>$request->input('coupon')])];
                }
            }
            if (!empty($request->input('country')) || !empty($request->input('address')) || !empty($request->input('postcode'))){
                $shipping = [
                    'country'   =>  [
                        'key'   =>  $request->input('country'),
                        'value' =>  get_country_lists()[$request->input('country')]
                    ],
                    'address'   =>  $request->input('address'),
                    'postcode'  =>  $request->input('postcode'),
                ];
                session(['shipping'=>$shipping]);
            }
        }
        if (!empty($request->input('remove_coupon'))){
            $re_coupon = [];
            foreach ($s_coupon as $coupon){
                if ($request->input('remove_coupon') == $coupon['name']) continue;
                array_push($re_coupon, $coupon);
            }
            session(['coupon' => $re_coupon]);
            $message = ['class'=>'bravo-message','text'=>__('Coupon ":coupon" has been removed.',['coupon'=>$request->input('remove_coupon')])];
        }
        $data = [
            'page_title' => __('Cart'),
            'user'       => Auth::user(),
            'message'  => $message,
            'show_breadcrumb'   => 0,
            'breadcrumbs'=>[
                ['name'=>__("Cart"),'class'=>'active']
            ],
            'coupons' => (!empty(session('coupon'))) ? session('coupon') : '',
        ];
        return view('Booking::frontend.cart', $data);
    }

    public function checkStatusCheckout($code)
    {
        $booking = $this->booking::where('code', $code)->first();
        $data = [
            'error'    => false,
            'message'  => '',
            'redirect' => ''
        ];
        if (empty($booking)) {
            $data = [
                'error'    => true,
                'redirect' => url('/')
            ];
        }
        if ($booking->customer_id != Auth::id()) {
            $data = [
                'error'    => true,
                'redirect' => url('/')
            ];
        }
        if ($booking->status != 'draft') {
            $data = [
                'error'    => true,
                'redirect' => url('/')
            ];
        }
        return response()->json($data, 200);
    }

    public function doCheckout(Request $request)
    {
        if(!Cart::count()){
            return $this->sendError(__("Your cart is empty"));
        }
        /**
         * Google ReCapcha
         */
        if(ReCaptchaEngine::isEnable() and setting_item("booking_enable_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                return $this->sendError(__("Please verify the captcha"));
            }
        }
        $rules = [
            'billing_first_name'      => 'required|string|max:255',
            'billing_last_name'       => 'required|string|max:255',
            'billing_email'           => 'required|string|email|max:255',
            'billing_phone'           => 'required|string|max:255',
            'billing_address_1'           => 'required|string|max:255',
            'billing_postcode'           => 'required|string|max:255',
            'country' => 'required',
            'payment_gateway' => 'required',
            'term_conditions' => 'required'
        ];
        if($request->input('createaccount')){
            $rules['account_password'] = 'required';
        }
        if($request->input('ship_to_different_address')){
            $rules = array_merge($rules,[
                'shipping_first_name'      => 'required|string|max:255',
                'shipping_last_name'       => 'required|string|max:255',
                'shipping_address_1'           => 'required|string|max:255',
                'shipping_postcode'           => 'required|string|max:255',
                'shipping_country' => 'required',
            ]);
        }
        if (!empty($rules)) {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->sendError('', ['errors' => $validator->errors()]);
            }
        }
        if (!empty($rules['payment_gateway'])) {
            $payment_gateway = $request->input('payment_gateway');
            $gateways = get_payment_gateways();
            if (empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway])) {
                return $this->sendError(__("Payment gateway not found"));
            }
            $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);
            if (!$gatewayObj->isAvailable()) {
                return $this->sendError(__("Payment gateway is not available"));
            }
        }
        $ship_to_different_address = $request->input('ship_to_different_address');
        try {
            $coupons = [];
            if (!empty(session('coupon'))){
                foreach (session('coupon') as $coupon){
                    $coupon_usage = Coupon::select('usage','per_coupon','per_user')->where('name',$coupon['name'])->first();
                    $usage = (empty($coupon_usage->usage)) ? 0 : $coupon_usage->usage;
                    $usage++;
                    Coupon::where('name',$coupon['name'])->update(['usage'=>$usage]);
                    array_push($coupons, $coupon);
                }
            }
            if (Cart::count()){
                foreach (Cart::content() as $item){
                    if ($item->options->has('variation_id')){
                        $variation = ProductVariation::where('id',$item->options->variation_id)->first();
                        $v_sold = (!empty($variation->sold)) ? $variation->sold : 0;
                        $nv_sold = $v_sold + $item->qty;
                        $v_in_stock = (!empty($variation->quantity) && $variation->quantity - $nv_sold <= 0) ? 'out' : 'in';
                        ProductVariation::where('id',$item->options->variation_id)->update(['sold'=>$nv_sold,'stock_status'=>$v_in_stock]);
                    } else {
                        $product = Product::where('id',$item->id)->first();
                        $sold = (!empty($product->sold)) ? $product->sold : 0;
                        $n_sold = $sold + $item->qty;
                        $in_stock = (!empty($product->quantity) && $product->quantity - $n_sold <= 0) ? 'out' : 'in';
                        Product::where('id',$item->id)->update(['sold'=>$n_sold,'stock_status'=>$in_stock]);
                    }
                }
            }
            $is_tmp_order = false;
            $order = new Order();
            if($tmp_order_id = session('tmp_order_id')){
                $tmpOrder = Order::find($tmp_order_id);
                if(empty($tmpOrder)){
                    $order = $tmpOrder;
                    $is_tmp_order = true;
                }
            }
            $user  = $this->maybeCreateUser($request,$is_tmp_order);

            // Normal Checkout
            $order->status = 'draft';
            $order->first_name = $request->input('billing_first_name');
            $order->last_name = $request->input('billing_last_name');
            $order->email = $request->input('billing_email');
            $order->phone = $request->input('billing_phone');
            $order->address = $request->input('billing_address_1');
            $order->address2 = $request->input('billing_address_2');
            $order->city = $request->input('billing_city');
            $order->postcode = $request->input('billing_postcode');
            $order->country = $request->input('country');
            $order->company = $request->input('billing_company');
            $order->gateway = $payment_gateway;
            $order->total = Cart::total();
            $order->final_total = Cart::final_total();
            $order->coupons = json_encode($coupons);
            $order->customer_id = Auth::id();

            if($ship_to_different_address){
                $order->shipping_first_name = $request->input('shipping_first_name');
                $order->shipping_last_name = $request->input('shipping_last_name');
                $order->shipping_address = $request->input('shipping_address_line_1');
                $order->shipping_address2 = $request->input('shipping_address_line_2');
                $order->shipping_city = $request->input('shipping_city');
                $order->shipping_postcode = $request->input('shipping_postcode');
                $order->shipping_country = $request->input('shipping_country');
                $order->shipping_company = $request->input('shipping_company');
            }else{
                $order->shipping_first_name = $request->input('billing_first_name');
                $order->shipping_last_name = $request->input('billing_last_name');
                $order->shipping_address = $request->input('billing_address_1');
                $order->shipping_address2 = $request->input('billing_address_12');
                $order->shipping_city = $request->input('billing_city');
                $order->shipping_postcode = $request->input('billing_postcode');
                $order->shipping_country = $request->input('country');
                $order->shipping_company = $request->input('billing_company');
            }

            $order->save();
            session(['tmp_order_id'=>$order->id]);
            $order->saveItems();

            $order->addMeta('locale', app()->getLocale());

            if($user) {
                $user->first_name = $request->input('billing_first_name');
                $user->last_name = $request->input('billing_last_name');
                $user->phone = $request->input('billing_phone');
                $user->address = $request->input('billing_address_1');
                $user->address2 = $request->input('billing_address_2');
                $user->city = $request->input('billing_city');
                $user->postcode = $request->input('billing_postcode');
                $user->country = $request->input('country');
                $user->company = $request->input('billing_company');


                if($ship_to_different_address) {
                    $user->shipping_first_name = $request->input('shipping_first_name');
                    $user->shipping_last_name = $request->input('shipping_last_name');
                    $user->shipping_address = $request->input('shipping_address_line_1');
                    $user->shipping_address2 = $request->input('shipping_address_line_2');
                    $user->shipping_city = $request->input('shipping_city');
                    $user->shipping_postcode = $request->input('shipping_postcode');
                    $user->shipping_country = $request->input('shipping_country');
                    $user->shipping_company = $request->input('shipping_company');
                }
                $user->save();
            }

            return $gatewayObj->process($request, $order);

        }catch (\Exception $exception)
        {
            return $this->sendError($exception->getMessage());
        }
    }

    public function maybeCreateUser(Request $request,$is_tmp_order = false){
        if(auth()->check()) return auth()->user();
        if($request->input('createaccount') and !$is_tmp_order)
        {
            $email = $request->input('billing_email');
            $userByEmail = \App\User::query()->where('email',$email)->first();
            if(!empty($userByEmail)){
                throw new \Exception(__('Email exists please login to continue'));
            }
            $user = new User();
            $user->first_name = $request->input('billing_first_name');
            $user->last_name = $request->input('billing_last_name');
            $user->phone = $request->input('billing_phone');
            $user->email = $request->input('billing_email');
            $user->status = $request->input('publish');
            $user->password = Hash::make($request->input('account_password'));

            $user->save();
            $user->assignRole('customer');
            Auth::loginUsingId($user->id);

            try {

                event(new SendMailUserRegistered($user));

            }catch (\Matrix\Exception $exception){

                Log::warning("SendMailUserRegistered: ".$exception->getMessage());

            }


            return $user;
        }
        return false;
    }


    public function confirmPayment(Request $request, $gateway)
    {

        $gateways = config('booking.payment_gateways');
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->confirmPayment($request);
    }

    public function cancelPayment(Request $request, $gateway)
    {

        $gateways = config('booking.payment_gateways');
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        return $gatewayObj->cancelPayment($request);
    }


    /**
     * @todo Handle Add To Cart Validate
     *
     * @param Request $request
     * @return string json
     */
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'   => 'required|integer',
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $service_type = $request->input('type');
        $service_id = $request->input('id');
        $variation_id = $request->input('variation_id');

        $allServices = get_product_types();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Product type not found'));
        }
        $module = $allServices[$service_type];
        $service = ($service_type == 'simple') ? $module::find($service_id) : $module::find($variation_id);

        if (empty($service) && $service->status != 'publish') {
            return $this->sendError(__('Product not found'));
        }

        return $service->addToCart($request);
    }
    public function removeCartItem(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }

        Cart::remove($request->input('id'));

        return $this->sendSuccess([
            'fragments'=>get_cart_fragments(),
            'reload'=>Cart::count()  ? false: true,
        ],__("Item removed"));
    }


    protected function getGateways()
    {

        $all = config('booking.payment_gateways');
        $res = [];
        foreach ($all as $k => $item) {
            if (class_exists($item)) {
                $obj = new $item($k);
                if ($obj->isAvailable()) {
                    $res[$k] = $obj;
                }
            }
        }
        return $res;
    }

    public function detail(Request $request, $code)
    {

        $booking = Order::where('code', $code)->first();
        $product_order = OrderItem::where('order_id',$booking->getAttributes()['id'])->get();

        if ($booking->status == 'draft') {
            return redirect($booking->getCheckoutUrl());
        }
        if ($booking->customer_id != Auth::id()) {
            abort(404);
        }
        $data = [
            'page_title' => __('Order Details'),
            'booking'    => $booking,
        ];
        if ($booking->gateway) {
            $data['gateway'] = get_payment_gateway_obj($booking->gateway);
            $data['order']  = $booking;
            $data['orders_list'] = $product_order;
        }
        return view('Booking::frontend.detail', $data);
    }
}
