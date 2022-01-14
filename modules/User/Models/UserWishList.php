<?php
namespace Modules\User\Models;
use App\BaseModel;
use Modules\Product\Models\Product;

class UserWishList extends BaseModel
{
    protected $table = 'user_wishlist';
    protected $fillable = [
        'object_id',
        'object_model',
        'user_id'
    ];

    public function service()
    {
        return $this->hasOne(Product::class, "id", 'object_id');
    }
}
