<?php
namespace Modules\Coupon\Models;
use App\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Order\Helpers\CartManager;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Product;
use Modules\User\Models\User;

class Coupon extends BaseModel
{
    protected $table = 'core_coupons';
    protected $casts = [
        'for_users'      => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function applyCoupon(){
        $cart_manager = app()->make(CartManager::class);
        // Validate Coupon
        $res = $this->applyCouponValidate();
        if ($res !== true)
            return $res;
        $cart_manager::storeCoupon($this);
        return [
            'status' =>  1,
            'message' => __("Coupon code is applied successfully!")
        ];
    }
    public function removeCoupon(){
        $cart_manager = app()->make(CartManager::class);
        // Validate Coupon
        $res = $this->applyCouponValidate();
        if ($res !== true)
            return $res;
        $cart_manager::removeCoupon($this);
        return [
            'status' =>  1,
            'message' => __("Coupon code is applied successfully!")
        ];
    }

    public function applyCouponValidate($action='add'){
        $cart_manager = app()->make(CartManager::class);
        $couponCart = $cart_manager::getCoupon();
        $subTotal = $cart_manager::subtotal();
        if($couponCart->where('id',$this->id)->where('status','publish')->first()){
	        return [
			        'status'=>0,
			        'message'=> __("Coupon code is added already!")
	        ];
        }
        if(!empty($end_date = $this->end_date)){
            $today = strtotime("today");
            if(  strtotime($end_date) < $today){
                return [
                    'status'=>0,
                    'message'=> __("This coupon code has expired!")
                ];
            }
        }
        if(!empty($min_total = $this->min_total) and $subTotal < $min_total){
            return [
                'status'=>0,
                'message'=> __("The order has not reached the minimum value of :amount to apply the coupon code!",['amount'=>format_money($min_total)])
            ];
        }
        if(!empty($max_total = $this->max_total) and $subTotal > $max_total){
            return [
                'status'=>0,
                'message'=> __("This order has exceeded the maximum value of :amount to apply coupon code! ",['amount'=>format_money($max_total)])
            ];
        }
        if($this->services->count() >0){
            $check = false;
            $items = $cart_manager::items();
            $items = $items->toArray();
            $services  = $this->services()->get(['object_id','object_model'])->toArray();
			foreach ($items as $item){
                if($check == false){
                    $check = \Arr::where($services,function ($value,$key) use ($item){
                        if($value['object_id']==$item['object_id'] and $value['object_model'] == $item['object_model']){
                            return $value;
                        }
                    });
                }
			}
            if(empty($check)){
                return [
                    'status'=>0,
                    'message'=> __("Coupon code is not applied to this product!")
                ];
            }
        }
        if(!empty($this->only_for_user)){
            if(empty($user_id = Auth::id())){
                return [
                    'status'=>0,
                    'message'=> __("You need to log in to use the coupon code!")
                ];
            }
            if($user_id != $this->only_for_user){
                return [
                    'status'=>0,
                    'message'=> __("Coupon code is not applied to your account!")
                ];
            }
        }
        if(!empty($this->for_users)){
            if(empty($user_id = Auth::id())){
                return [
                    'status'=>0,
                    'message'=> __("You need to log in to use the coupon code!")
                ];
            }
            if(!in_array($user_id,$this->for_users)){
                return [
                    'status'=>0,
                    'message'=> __("Coupon code is not applied to your account!")
                ];
            }
        }
        if(!empty($quantity_limit = $this->quantity_limit)){
            $count = CouponOrder::where('coupon_code',$this->code)->whereNotIn('order_status',['draft','unpaid','cancelled'])->count();
            if($quantity_limit <= $count){
                return [
                    'status'=>0,
                    'message'=> __("This coupon code has been used up!")
                ];
            }
        }
        if(!empty($limit_per_user = $this->limit_per_user)){
            if(empty($user_id = Auth::id())){
                return [
                    'status'=>0,
                    'message'=> __("You need to log in to use the coupon code!")
                ];
            }
            $count = CouponOrder::where('coupon_code',$this->code)->where("create_user",$user_id)->whereNotIn('order_status',['draft','unpaid','cancelled'])->count();
            if($limit_per_user <= $count){
                return [
                    'status'=>0,
                    'message'=> __("This coupon code has been used up!")
                ];
            }
        }
        return true;
    }

    public function services(){
        return $this->hasMany( CouponServices::class, 'coupon_id');
    }
    public function getServicesToArray(){
        $services = $this->services()->with('service')->get();
        $data = [];
        if(!empty($services)){
            foreach ($services as $item){
                $data[] = [
                    'id'   => $item->service->id,
                    'text' => "(#{$item->service->id}): {$item->service->title}"
                ];
            }
        }
        return $data;
    }
    public function getForUsersToArray(){

        $data = [];
        if(!empty($this->for_users)){
            $users = User::whereIn('id',$this->for_users)->get();
            if(!empty($users)){
                foreach ($users as $user){
                    $data[] = [
                        'id'   => $user->id,
                        'text' => "(#{$user->id}): {$user->display_name}"
                    ];
                }
            }
        }
        return $data;
    }
    public function calculatePrice($price){
		//for Type Fixed
	    $coupon_amount = $this->amount;
	    //for Type Percent
	    if($this->discount_type == 'percent'){
		    $coupon_amount =  $price / 100 * $this->amount;
	    }
	    return $coupon_amount;
    }

}
