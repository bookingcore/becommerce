<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Models\Product;
use Modules\Review\Models\Review;
use Modules\Review\Resources\ReviewResource;

class ReviewController extends ApiController
{
    public $product;
    public $review;
    public function __construct(Product $product,Review $review)
    {
        $this->product = $product;
        $this->review = $review;
    }

    public function index($id){

        $row = $this->product::find($id);
        if(!$row or $row->status != 'publish'){
            abort(404);
            return;
        }
        return ReviewResource::collection($row->review_list()->orderBy("id", "desc")->with(['author'])->paginate(10));
    }

    public function store(Request $request,$id){

        $row = $this->product::find($id);
        if(!$row or $row->status != 'publish'){
            abort(404);
            return;
        }


        $reviewEnable = $row->getReviewEnable();
        if (!$reviewEnable) {
            return $this->sendError(__("Review is not enable"),['code'=>404]);
        }

        if($row->isReviewRequirePurchase() and !$row->isBought()){
            return $this->sendError(__("You need to purchase a service to write a review"),['code'=>403]);
        }

        $rules = [
            'review_title'   => 'required',
            'review_content' => 'required|min:10'
        ];
        $messages = [
            'review_title.required'   => __('Review Title is required field'),
            'review_content.required' => __('Review Content is required field'),
            'review_content.min'      => __('Review Content has at least 10 character'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->sendError('',['errors'=>$validator->errors()]);
        }

        if($review = $this->review::addReview($request,$row,$row->type,$row->id)){
            $msg = __('Review success!');
            if ($row->getReviewApproved()) {
                $msg = __("Review success! Please wait for admin approved!");
            }
            return $this->sendSuccess([
                'data'=>new ReviewResource($review)
            ],$msg);
        }
        return $this->sendError(__("Can not save review"),['code'=>500]);
    }
}
