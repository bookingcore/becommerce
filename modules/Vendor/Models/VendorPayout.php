<?php


namespace Modules\Vendor\Models;


use App\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Modules\Order\Models\OrderItem;

class VendorPayout extends BaseModel
{

    use SoftDeletes;

    const PENDING = 'pending';

    protected $table = 'vendor_payouts';

    protected $casts = [
        'account_info'=>'array'
    ];

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

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id');
    }

    public function getDateAttribute(){
        return new \DateTime($this->year.'-'.$this->month.'-01');
    }
    public function getMethodNameAttribute(){
        $all = setting_item_array('vendor_payout_methods');
        foreach ($all as $item){
            if(!isset($item['id'])) continue;
            if($item['id'] == $this->payout_method) return $item['name'] ?? '';
        }
        return $this->payout_method;
    }
}
