<?php
namespace Modules\Coupon\Models;

use App\BaseModel;

class CouponOrder extends BaseModel
{
    protected $table = 'core_coupon_order';
    protected $fillable = [
        'order_id',
        'order_status',
        'object_id',
        'object_model',
        'coupon_code',
        'coupon_amount',
        'coupon_data',
    ];
    protected $casts = [
        'coupon_data' => 'array',
    ];

    public function clean($coupon_id)
    {
        $query = $this->where("order_id", $coupon_id);
        $query->get();
        if (!empty($query)) {
            $query->delete();
        }
    }
}
