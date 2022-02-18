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

    protected $table = 'vendor_payouts';

    public static function getAllStatuses(){
        return [
            'initial'=>[
                'title'=>__("Initial")
            ],
            'confirmed'=>[
                'title'=>__("Confirmed")
            ],
            'paid'=>[
                'title'=>__("Paid")
            ],
            'rejected'=>[
                'title'=>__("Rejected")
            ],
        ];
    }

    public function calculateTotal(){
        $this->total = OrderItem::query()
            ->where('payout_id',$this->id)
            ->sum(DB::raw("subtotal - discount_amount - commission_amount"));

        $this->save();
    }
}
