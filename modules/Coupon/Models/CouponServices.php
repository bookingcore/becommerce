<?php


namespace Modules\Coupon\Models;


use App\BaseModel;
use Modules\Product\Models\Product;

class CouponServices extends BaseModel
{

    protected $table = 'core_coupon_services';

    protected $fillable = [
        'coupon_id',
        'object_id',
        'object_model',
    ];

    public function service(){
        switch ($this->object_model){
            default:
                return $this->belongsTo(Product::class,'object_id','id');
                break;
        }
    }

    public function clean($coupon_id){
        $query = $this->where("coupon_id", $coupon_id);
        $query->get();
        if(!empty($query)){
            $query->delete();
        }
    }
}
