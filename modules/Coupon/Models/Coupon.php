<?php
namespace Modules\Coupon\Models;
use App\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Bookable;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Service;
use Modules\Order\Helpers\CartManager;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Product;

class Coupon extends Bookable
{
    protected $table = 'core_coupons';
    protected $casts = [
        'services'      => 'array',
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function applyCoupon(){
        // Validate Coupon
        $res = $this->applyCouponValidate();
        if ($res !== true)
            return $res;
        CartManager::storeCoupon($this);
        return [
            'status' =>  1,
            'message' => __("Coupon code is applied successfully!")
        ];
    }
    public function removeCoupon(){
        // Validate Coupon
        $res = $this->applyCouponValidate();
        if ($res !== true)
            return $res;
        CartManager::storeCoupon($this);
        return [
            'status' =>  1,
            'message' => __("Coupon code is applied successfully!")
        ];
    }

    public function applyCouponValidate(){
        $couponCart = CartManager::getCoupon();
        $totalBeforeDiscount = CartManager::totalBeforeDiscount();
        if($couponCart->where('id',$this->id)->first()){
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

        if(!empty($min_total = $this->min_total) and $totalBeforeDiscount < $min_total){
            return [
                'status'=>0,
                'message'=> __("The order has not reached the minimum value of :amount to apply the coupon code!",['amount'=>format_money($min_total)])
            ];
        }
        if(!empty($max_total = $this->max_total) and $totalBeforeDiscount > $max_total){
            return [
                'status'=>0,
                'message'=> __("This order has exceeded the maximum value of :amount to apply coupon code! ",['amount'=>format_money($max_total)])
            ];
        }
        if(!empty($this->services)){
            $check = false;
            $items = CartManager::items();
            $items = $items->pluck(['object_id','object_model'])->toArray();
	        $services  = $this->services->pluck(['object_id','object_model'])->toArray();
			foreach ($items as $item){
				$check = \Arr::where($services,function ($value,$key) use ($item){
					if($value['object_id']==$item['object_id'] and $value['object_model'] == $item['object_model']){
						return $value;
					}
				});
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
        return $this->hasMany( Product::class, 'coupon_id');
    }

    public function calculatorPrice($price){
		//for Type Fixed
	    $coupon_amount = $this->amount;
	    //for Type Percent
	    if($this->discount_type == 'percent'){
		    $coupon_amount =  $price / 100 * $this->amount;
	    }
	    return $coupon_amount;
    }
   
}