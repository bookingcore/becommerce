<?php


namespace Modules\Vendor\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Modules\Order\Models\OrderItem;

class VendorPayout extends BaseModel
{

    use SoftDeletes;

    const PENDING = 'pending';

    protected $table = 'user_payouts';

    public function calculateTotal(){
        $this->total = OrderItem::query()
            ->where('payout_id',$this->id)
            ->sum(DB::raw("subtotal - discount_amount - commission_amount"));

        $this->save();
    }
}
