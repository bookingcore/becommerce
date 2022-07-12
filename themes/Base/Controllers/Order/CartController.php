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
            'page_title'=>__("Shopping Cart"),
            'cart'=>$this->cart_manager::cart()
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
        $vendor_id = $request->input('vendor_id');

        $allServices = get_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Service type not found'),['code'=>404]);
        }
        $module = app()->make($allServices[$service_type]);

        $service = $module::find($service_id);
        try {
            $cartItem = $this->cart_manager::findItem($service,$variation_id);
            $is_group_product = false;

            $service->addToCartValidate($request->input('quantity') + ($cartItem->qty ?? 0),$variation_id,$vendor_id);

            switch($service->product_type){
                case 'grouped':
                    $quantity = 0;
                    $is_group_product = true;
                    $children_input = $request->input('children',[]);
                    foreach ($service->children as $child){
                        if($child->product_type == 'simple' and !empty($children_input[$child->id]))
                        {
                            $this->cart_manager::add($child,$child->name,$children_input[$child->id],min($child->price,$child->sale_price));
                            $quantity += $children_input[$child->id];
                        }
                    }
                    break;
                default:
                    $this->cart_manager::add($service,$service->name,$quantity,min($service->price,$service->sale_price),[],$variation_id);
                    break;
            }


            $buy_now = $request->input('buy_now');

            if(is_api()){
                return $this->sendSuccess([
                    'data'=>new CartResource(CartManager::cart())
                ]);
            }

            $message = __('":title" has been added to your cart.',['title'=>$service->title]);
            if($is_group_product){
                $message = __(':count product(s) added to your cart',['count'=>$quantity]);
            }
            return $this->sendSuccess([
                'fragments'=>!is_api() ? $this->cart_manager::fragments() : [],
                'url'=>$buy_now ? route('checkout') : '',
            ],
                !$buy_now ? $message :''
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
            $this->cart_manager::cart()->syncDiscount();

        }catch (\Exception $exception)
        {
            return back()->with('error',$exception->getMessage());
        }
        return back()->with('success','Cart updated');

    }

    public function getShippingMethod(Request $request){
        $validator = \Validator::make($request->all(), [
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $res = $this->cart_manager::getMethodShipping($request->input('country'));
        return $this->sendSuccess($res,$res['message'] ?? "");
    }

    public function getTaxRate(Request $request){
        $validator = \Validator::make($request->all(), [
            'billing_country' => 'required',
            'shipping_country' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $res = $this->cart_manager::getTaxRate($request->input('billing_country'),$request->input('shipping_country'));
        return $this->sendSuccess($res,$res['message'] ?? "");
    }
}
