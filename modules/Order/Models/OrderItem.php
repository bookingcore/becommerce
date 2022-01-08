<?php


namespace Modules\Order\Models;


use App\BaseModel;
use App\Traits\HasMeta;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if(array_key_exists($this->object_model,$keys)){
            return $keys[$this->object_model]::find($this->object_id);
        }
        return false;
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function getStatusNameAttribute()
    {
        return booking_status_to_text($this->status);
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
        $query = parent::query()->select(['core_oder_items.*','core_orders.customer_id']);
        $query->join('core_orders','core_orders.id','=','core_order_items.order_id');

        if(!empty($filters['vendor_id']))
        {
            $query->where('vendor_id',$filters['vendor_id']);
        }
        return $query;
    }
}
