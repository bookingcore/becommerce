<?php


namespace Modules\Order\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMeta extends BaseModel
{
    protected $table = 'core_payment_meta';


    protected $fillable = [
        'name' ,
        'val'  ,
        'payment_id',
    ];
}
