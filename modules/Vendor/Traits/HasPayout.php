<?php


namespace Modules\Vendor\Traits;


use Modules\Vendor\Models\VendorPayout;
use Modules\Vendor\Models\VendorPayoutAccount;

trait HasPayout
{

    public function payouts(){
        return $this->hasMany(VendorPayout::class,'vendor_id');
    }

    public function current_payout(){
        return $this->hasOne(VendorPayout::class,'vendor_id')->orderByDesc('id');
    }

    public function payout_account(){
        return $this->hasOne(VendorPayoutAccount::class,'vendor_id');
    }
}
