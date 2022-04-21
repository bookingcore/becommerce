<?php


namespace Modules\Product\Traits;


use Modules\Product\Models\ProductOnHold;

trait HasStockValidation
{

    public function productOnHold(){
        return $this->hasMany(ProductOnHold::class,'product_id','id')->where('expired_at','>',now());
    }

    public function getOnHoldAttribute()
    {
        return $this->productOnHold()->sum('qty');
    }
    public function getRemainStockAttribute()
    {
        return $this->quantity - $this->on_hold;
    }


    public function check_manage_stock(){
        if(setting_item('product_enable_stock_management')){
            return $this->is_manage_stock;
        }
        return false;
    }
    public function stockValidation($qty)
    {
        $isManageStock  = $this->check_manage_stock();
        if(!empty($isManageStock)){
            $onHold = $this->on_hold;
            if(!empty($this->quantity)){
                $remainStock = $this->quantity - $onHold;
                if($qty>$remainStock){
                    throw new \Exception(__(':product_name remain stock: :remain remaining.',['product_name'=>$this->title,'remain'=>$remainStock]),406);
                }
            }else{
                throw new \Exception(__(':product_name is out of stock',['product_name'=>$this->title]),406);
            }
        }else{
            if($this->stock_status ==='out'){
                throw new \Exception(__(':product_name is out of stock',['product_name'=>$this->title]),406);
            }
        }
    }
}
