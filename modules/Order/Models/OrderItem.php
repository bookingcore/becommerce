<?php


namespace Modules\Order\Models;


use App\BaseModel;
use App\Traits\HasMeta;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\Product;

class OrderItem extends BaseModel
{

    use SoftDeletes;
    use HasMeta;
    protected $table = 'core_order_items';

    protected $metaClass = OrderItemMeta::class;

    protected $casts = [
        'meta'=>'array'
    ];

    public function model(){
        $keys = get_bookable_services();
        if(!empty($keys[$this->object_model])){
            return $this->belongsTo($keys[$this->object_model],'object_id');
        }else{
            return $this->belongsTo(Product::class,'object_id');
        }
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function getSubtotalAttribute(){
        return $this->price * $this->qty + $this->extra_price_total;
    }

    public function getExtraPriceTotalAttribute(){
        $t = 0;
        if(!empty($this->meta['extra_prices']))
        {
            foreach ($this->meta['extra_prices'] as $extra_price){
                $t += (float)($extra_price['price']);
            }
        }
        return $t;
    }

    public function search($filters = [])
    {
        $query = parent::query()->select(['core_order_items.*','core_orders.customer_id']);
        $query->join('core_orders','core_orders.id','=','core_order_items.order_id');

        if(!empty($filters['vendor_id']))
        {
            $query->where('vendor_id',$filters['vendor_id']);
        }
        return $query;
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function save(array $options = [])
    {

        if(!$this->locale){
            $this->locale = app()->getLocale();
        }
        if(!$this->order_date){
            $this->order_date = Carbon::now();
        }
        if($this->isDirty(['price','qty']))
        {
            $this->calculateCommission();
        }
        return parent::save($options); // TODO: Change the autogenerated stub
    }

    public function calculateCommission(){
        if(is_vendor_enable()){

        }
    }
}
