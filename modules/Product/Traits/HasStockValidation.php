<?php


namespace Modules\Product\Traits;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Product\Models\ProductOnHold;

trait HasStockValidation
{

    public function productOnHold(){
        return $this->hasMany(ProductOnHold::class,'product_id','id')->where('expired_at','>',now());
    }

    protected function onHold():Attribute{
        return Attribute::make(
            get:function(){
                return 0;// disable on-hold for the moment
            }
        );
    }

    protected function remainStock():Attribute{
        return Attribute::make(
            get:function(){
                return max(0,$this->quantity - $this->on_hold);
            }
        );
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
            if(!empty($this->quantity)){
                $remainStock = $this->remain_stock;
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
