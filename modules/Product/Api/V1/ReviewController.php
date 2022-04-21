<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Product\Models\Product;
use Modules\Review\Resources\ReviewResource;

class ReviewController extends ApiController
{
    public $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index($id){

        $row = $this->product::find($id);
        if(!$row or $row->status != 'publish'){
            abort(404);
            return;
        }
        return ReviewResource::collection($row->review_list()->orderBy("id", "desc")->with(['author'])->paginate(10));
    }
}
