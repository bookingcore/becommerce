<?php


namespace Modules\Product\Repositories\Eloquent;


use App\Repositories\BaseEloquentRepository;
use Modules\Product\Models\Product;

class ProductRepository extends BaseEloquentRepository
{
    public function model()
    {
        return Product::class;
    }
}
