<?php
namespace Modules\Product\Models;

use App\BaseModel;
use App\User;

class OrderItem extends BaseModel
{
    protected $table = 'product_order_items';
    public function getCommissionVendor(){
        $vendorId = $this->vendor_id;
        $total = $this->subtotal;
        $returnArray=[
            'commission'=>0,
            'commission_type'=>'',
        ];
        if (setting_item('vendor_enable') == 1) {
            $vendor = User::find($vendorId);
            if (!empty($vendor)) {
                $commission = [];
                $commission['amount'] = setting_item('vendor_commission_amount', 10);
                $commission['type'] = setting_item('vendor_commission_type', 'percent');

                if($vendor->vendor_commission_type){
                    $commission['type'] = $vendor->vendor_commission_type;
                }
                if($vendor->vendor_commission_amount){
                    $commission['amount'] = $vendor->vendor_commission_amount;
                }

                if ($commission['type'] == 'percent') {
                    $returnArray['commission'] = (float)($total / 100) * $commission['amount'];
                } else {
                    $returnArray['commission']= (float)min($total,$commission['amount']);
                }
                $returnArray['commission_type'] = json_encode($commission);
            }
        }
        return $returnArray;
    }
    public function calculateCommission(){
        $data = $this->getCommissionVendor();

        $this->commission = $data['commission'];
        $this->commission_type = $data['commission_type'];
    }

    public function product(){

    }
}
