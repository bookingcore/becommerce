<?php


namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Booking\Models\Bookable;
use Modules\Product\Models\Product;

class CartItem extends Model
{
    public $incrementing = false;

    protected $class_name;



    protected $attributes = [
        "name"=>"",
        "qty"=>1,
        "meta"=>"",
        "product_id"=>"",
        "object_id"=>"",
        "object_model"=>"",
        "price"=>0,
        "discount_amount"=>0, // counpon discount amount
        "shipping_amount"=>0, // shipping amount nếu có
        "author"=>"",
        "variant_id"=>""
    ];

    public static function fromProduct(Product $model,$qty = 1,$price = 0, $meta = [],$variant_id = ''){

        $item = new self();

        $item->class_name = get_class($model);

        $item->product_id = $model->id;
        $item->qty = $qty;
        $item->name = $model->title;
        $item->price = $price ? $price : $model->price ;
        $item->object_id = $model->id;
        $item->object_model = $model->type;
        $item->meta = $meta;
        $item->author = $model->author->display_name;
        $item->variant_id = $variant_id;

        $item->generateId();

        return $item;
    }
    public static function fromModel(Bookable $model,$qty = 1,$price = 0, $meta = [],$variant_id = ''){

        $item = new self();

        $item->class_name = get_class($model);

        $item->product_id = $model->id;
        $item->qty = $qty;
        $item->name = $model->name_for_cart;
        $item->price = $price ? $price : $model->price_for_cart ;
        $item->object_id = $model->id;
        $item->object_model = $model->type;
        $item->meta = $meta;
        $item->author = $model->author->display_name;
        $item->variant_id = $variant_id;

        $item->generateId();

        return $item;
    }

    public static function fromAttribute($id,$name = '', $qty = 1, $price = 0, $meta = [],$variant_id = ''){
        $item = new self();

        $item->product_id = $id;
        $item->qty = $qty;
        $item->name = $name;
        $item->meta = $meta;
        $item->price = $price;
        $item->variant_id = $variant_id;

        $item->generateId();

        return $item;
    }

    public function model(){
        return $this->belongsTo($this->class_name,'object_id');
    }


    protected function generateId(){
        if(!$this->id)
        $this->id = uniqid().rand(0,99999);
    }

    public function getSubtotalAttribute(){
        return $this->price * $this->qty + $this->extra_price_total;
    }
    public function getSubtotalDiscountAttribute(){
        return $this->price * $this->qty + $this->extra_price_total - $this->discount_amount;
    }

    public function getDetailUrl(){
        if($this->model){
            return $this->model->getDetailUrl();
        }
        return '';
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
}
