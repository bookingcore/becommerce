<?php


namespace Themes\Base\Controllers\Order;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Order\Resources\Frontend\CartResource;
use Modules\Product\Models\ShippingZone;
use Themes\Base\Controllers\FrontendController;
use Modules\Order\Helpers\CartManager;

class CartController extends FrontendController
{

    protected $cart_manager;

    public function __construct(CartManager $cart_manager)
    {
        parent::__construct();
        $this->cart_manager = $cart_manager;
    }

    public function index(Request $request){
        $data = [
            'items'=>$this->cart_manager::items(),
            'counpon'=>$this->cart_manager::getCoupon(),
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
            'object_model.required'=>__("Service type is required"),
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

        $allServices = get_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Service type not found'),['code'=>404]);
        }
        $module = $allServices[$service_type];
        $service = $module::find($service_id);
        try {
            $cartItem = $this->cart_manager::findItem($service,$variation_id);

            $service->addToCartValidate($request->input('quantity') + ($cartItem->qty ?? 0),$variation_id);

            $this->cart_manager::add($service,$service->name,$quantity,min($service->price,$service->sale_price),[],$variation_id);

            $buy_now = $request->input('buy_now');

            if(is_api()){
                return $this->sendSuccess([
                    'data'=>new CartResource(CartManager::cart())
                ]);
            }
            return $this->sendSuccess([
                'fragments'=>!is_api() ? $this->cart_manager::fragments() : [],
                'url'=>$buy_now ? route('checkout') : '',
            ],
                !$buy_now ? __('":title" has been added to your cart.',['title'=>$service->title]) :''
            );

        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage(),['code'=>$exception->getCode() ?  $exception->getCode() : 'add_to_cart']);
        }

    }
    public function removeCartItem(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }

        $this->cart_manager::remove($request->input('id'));

        return $this->sendSuccess([
            'fragments'=> $this->cart_manager::fragments(),
            'reload'=>$this->cart_manager::count()  ? false: true,
        ],__("Item removed"));
    }

    public function updateCartItem(Request $request){

        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_email_verification')){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }

        $itemsRequest = $request->input('cart_item',[]);
        try {
            foreach ($itemsRequest as $item_id => $value) {
                $qty = $value['qty'];
                $cartItem = $this->cart_manager::item($item_id);
                if(!$cartItem){
                    $this->cart_manager::remove($item_id);
                }else{
                    if($this->cart_manager::validateItem($cartItem, $qty)){
                        $this->cart_manager::update($item_id,$qty);
                    }
                }
            }
            $this->cart_manager::calculatorDiscountCoupon();

        }catch (\Exception $exception)
        {
            return back()->with('error',$exception->getMessage());
        }
        return back()->with('success','Cart updated');

    }

    public function getShippingMethod(Request $request){
        $res = $this->cart_manager::getMethodShipping($request->input('country'));
        return $this->sendSuccess($res,$res['message'] ?? "");
    }

    public function getTaxRate(Request $request){
        $res = $this->cart_manager::getTaxRate($request->input('billing_country'),$request->input('shipping_country'));
        return $this->sendSuccess($res,$res['message'] ?? "");
    }
}
