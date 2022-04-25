<?php


namespace Modules\Order\Models;


use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    public $incrementing = false;

    protected $attributes = [
        'id',
        'coupons',
        'total_discount'
    ];

    protected $casts = [
        'coupons'=>AsCollection::class
    ];
    public function items(){
        return $this->hasMany(CartItem::class);
    }

    public function clear(){
        Session::forget($this->_session_key);
    }

    public function fromData($data){
        if(empty($data) or empty($data['items'])){
            $this->setRelation("items",collect([]));
        }
        foreach ($data as $k=>$value){
            switch ($k){
                case "items":
                    if(is_array($value)){
                        $items = collect();
                        foreach ($value as $v2){
                            $items->push(CartItem::fromArray($v2));
                        }
                        $this->setRelation("items",$items);
                    }
                    break;
                default:
                    $this->setAttribute($k,$value);
                    break;
            }
        }
    }
}
