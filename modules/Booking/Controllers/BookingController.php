<?php
namespace Modules\Booking\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mockery\Exception;
//use Modules\Booking\Events\VendorLogPayment;
use Modules\Tour\Models\TourDate;
use Modules\User\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Product\Models\Coupon;

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

        /**
         * @param Booking $booking
         */
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $code = $request->input('code');
        $booking = $this->booking::where('code', $code)->first();
        if (empty($booking)) {
            abort(404);
        }
        if ($booking->customer_id != Auth::id()) {
            abort(404);
        }
        if ($booking->status != 'draft') {
            return $this->sendError('',[
                'url'=>$booking->getDetailUrl()
            ]);
        }
        $service = $booking->service;
        if (empty($service)) {
            return $this->sendError(__("Service not found"));
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
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|string|email|max:255',
            'phone'           => 'required|string|max:255',
            'country' => 'required',
            'payment_gateway' => 'required',
            'term_conditions' => 'required'
        ];
        $rules = $service->filterCheckoutValidate($request, $rules);
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
        $service->beforeCheckout($request, $booking);
        // Normal Checkout
        $booking->first_name = $request->input('first_name');
        $booking->last_name = $request->input('last_name');
        $booking->email = $request->input('email');
        $booking->phone = $request->input('phone');
        $booking->address = $request->input('address_line_1');
        $booking->address2 = $request->input('address_line_2');
        $booking->city = $request->input('city');
        $booking->state = $request->input('state');
        $booking->zip_code = $request->input('zip_code');
        $booking->country = $request->input('country');
        $booking->customer_notes = $request->input('customer_notes');
        $booking->gateway = $payment_gateway;
        $booking->save();

//        event(new VendorLogPayment($booking));

        $user = Auth::user();
        $user->billing_first_name = $request->input('first_name');
        $user->billing_last_name = $request->input('last_name');
        $user->billing_phone = $request->input('phone');
        $user->billing_address = $request->input('address_line_1');
        $user->billing_address2 = $request->input('address_line_2');
        $user->billing_city = $request->input('city');
        $user->billing_state = $request->input('state');
        $user->billing_zip_code = $request->input('zip_code');
        $user->billing_country = $request->input('country');
        $user->save();

        $booking->addMeta('locale',app()->getLocale());

        $service->afterCheckout($request, $booking);
        try {

            $gatewayObj->process($request, $booking, $service);
        } catch (Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
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
            return $this->sendError(__('Service type not found'));
        }
        $module = $allServices[$service_type];
        $service = ($service_type == 'simple') ? $module::find($service_id) : $module::find($variation_id);

        if (empty($service)) {
            return $this->sendError(__('Service not found'));
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

        $booking = Booking::where('code', $code)->first();
        if (empty($booking)) {
            abort(404);
        }

        if ($booking->status == 'draft') {
            return redirect($booking->getCheckoutUrl());
        }
        if ($booking->customer_id != Auth::id()) {
            abort(404);
        }
        $data = [
            'page_title' => __('Booking Details'),
            'booking'    => $booking,
            'service'    => $booking->service,
        ];
        if ($booking->gateway) {
            $data['gateway'] = get_payment_gateway_obj($booking->gateway);
        }
        return view('Booking::frontend/detail', $data);
    }
}
