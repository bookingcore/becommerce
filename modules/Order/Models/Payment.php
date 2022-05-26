<?php


namespace Modules\Order\Models;


use App\BaseModel;
use App\Traits\HasMeta;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Events\PaymentUpdated;

class Payment extends BaseModel
{
    use SoftDeletes, HasMeta;

    protected $meta_parent_key = 'payment_id';
    protected $metaClass = PaymentMeta::class;

    CONST COMPLETED = 'completed';
    CONST PENDING = 'pending';
    const FAILED = 'failed';


    protected $table = 'core_payments';

    protected $attributes = [
        'status'=>'draft'
    ];

    protected $casts = [
        'logs'=>'array'
    ];


    public function getDetailUrl(){
        switch ($this->object_model){
            case "order":
                $order = Order::find($this->object_id);
                $url = $order->getDetailUrl();
                break;
        }
        return $url;
    }
    public function order(){
        switch ($this->object_model){
            default:
                return $this->belongsTo(Order::class,'object_id')->withDefault();
        }
    }

    public function updateStatus($status){
        $this->status = $status;
        $this->save();

        PaymentUpdated::dispatch($this);
    }

}
