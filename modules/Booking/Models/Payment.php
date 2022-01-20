<?php
namespace Modules\Booking\Models;

use App\BaseModel;
use Illuminate\Support\Facades\DB;
use Modules\Order\Models\PaymentMeta;
use Modules\Tour\Models\Tour;

class Payment extends BaseModel
{
    protected $table = 'product_order_payments';
    public function meta(){
        return $this->hasMany(PaymentMeta::class,'payment_id');
    }
}
