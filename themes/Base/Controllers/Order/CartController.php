<?php


namespace Themes\Base\Controllers\Order;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Models\ShippingZone;
use Themes\Base\Controllers\FrontendController;
use Modules\Order\Helpers\CartManager;

class CartController extends FrontendController
{

    public function index(Request $request){
        $data = [
            'items'=>CartManager::items(),
            'counpon'=>CartManager::getCoupon(),
            'breadcrumbs'=>[
                [
                    'name'=> "Shopping Cart",
                ]
            ],
            'page_title'=>__("Shopping Cart")
        ];

        return view('order.cart.index',$data);
    }

    public function addToCart(Request $request)
    {
        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_email_verification')){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }

        $validator = Validator::make($request->all(), [
            'object_id'   => 'required|integer',
            'object_model' => 'required',
            'quantity' => 'required',
        ],[
            'object_model.required'=>__("Service id is required"),
            'object_id.required'=>__("Service id is required"),
            'object_id.integer'=>__("Service id is integer"),
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $service_type = $request->input('object_model');
        $quantity = $request->input('quantity');
        $service_id = $request->input('object_id');
        $variation_id = $request->input('variation_id');

        $allServices = get_bookable_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Service type not found'));
        }
        $module = $allServices[$service_type];
        $service = $module::find($service_id);
        try {
            $cartItem = CartManager::findItem($service,$variation_id);

            $service->addToCartValidate($request->input('quantity') + ($cartItem->qty ?? 0),$variation_id);

            CartManager::add($service,$service->name,$quantity,$service->price,[],$variation_id);

            $buy_now = $request->input('buy_now');

            return $this->sendSuccess([
                'fragments'=>CartManager::fragments(),
                'url'=>$buy_now ? route('checkout') : '',
            ],
                !$buy_now ? __('":title" has been added to your cart.',['title'=>$service->title]) :''
            );

        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }

    }
    public function removeCartItem(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }

        CartManager::remove($request->input('id'));

        return $this->sendSuccess([
            'fragments'=> CartManager::fragments(),
            'reload'=>CartManager::count()  ? false: true,
        ],__("Item removed"));
    }

    public function updateCartItem(Request $request){

        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_email_verification')){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }

        $itemsRequest = $request->input('cart_item');
        try {
            foreach ($itemsRequest as $item_id => $value) {
                $qty = $value['qty'];
                $cartItem = CartManager::item($item_id);
                if(!$cartItem){
                    CartManager::remove($item_id);
                }else{
                    if(CartManager::validateItem($cartItem, $qty)){
                        CartManager::update($item_id,$qty);
                    }
                }

            }
        }catch (\Exception $exception)
        {
            return back()->with('error',$exception->getMessage());
        }
        return back()->with('success','Cart updated');

    }

    public function getShippingMethod(Request $request){
        $res = CartManager::getMethodShipping($request->input('country'));
        return $this->sendSuccess($res,$res['message'] ?? "");
    }

    public function getTaxRate(Request $request){
        $res = CartManager::getTaxRate($request->input('billing_country'),$request->input('shipping_country'));
        return $this->sendSuccess($res,$res['message'] ?? "");
    }
}
