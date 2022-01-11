<?php


namespace Themes\Base\Controllers\Order;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Themes\Base\Controllers\FrontendController;
use Modules\Order\Helpers\CartManager;

class CartController extends FrontendController
{

    public function index(Request $request){
        $data = [
            'items'=>CartManager::items(),
            'counpon'=>CartManager::getCoupon(),
            'page_title'=>__("Shopping Cart")
        ];
        return view('order.cart.index',$data);
    }

    public function addToCart(Request $request)
    {
        if(!Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_verify_email_register_user')==1){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }

        $validator = Validator::make($request->all(), [
            'id'   => 'required|integer',
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $service_type = $request->input('type');
        $service_id = $request->input('id');
        $allServices = get_bookable_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Service type not found'));
        }
        $module = $allServices[$service_type];
        $service = $module::find($service_id);
        try {
            $service->addToCartValidate($request->input('qty'),$request->input('variant_id'));
            CartManager::add($service);
            $buy_now = $request->input('buy_now');
            return $this->sendSuccess([
                'fragments'=>CartManager::get_cart_fragments(),
                'url'=>$buy_now ? route('checkout') : ''
            ],
                !$buy_now ? __('":title" has been added to your cart.',['title'=>$this->title]) :''
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
            'fragments'=> CartManager::get_cart_fragments(),
            'reload'=>CartManager::count()  ? false: true,
        ],__("Item removed"));
    }
    public function updateCartItem(Request $request){

        if(!Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }

        if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_verify_email_register_user')==1){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }

        $itemsRequest = $request->input('cart_item');
        foreach ($itemsRequest as $item=>$value){
            $qty = $value['qty'];
            CartManager::update($item,$qty);
        }
        return back()->with('success','Your cart updated');

    }


}
