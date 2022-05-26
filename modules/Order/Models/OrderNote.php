<?php


namespace Modules\Order\Models;


use App\BaseModel;

class OrderNote extends BaseModel
{
    const STATUS_CHANGED = 'status_changed';

    protected $table = 'core_order_notes';

    protected $fillable = [
        'name',
        'value',
        'extra'
    ];

    protected $casts = [
        'extra'=>'array'
    ];

}
