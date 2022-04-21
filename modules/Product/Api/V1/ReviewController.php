<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\News\Models\News;
use Modules\Product\Models\Product;
use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;
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
        $request->validate($rules,$messages);

        $all_stats = setting_item($row->type."_review_stats");
        $review_stats = $request->input('review_stats');
        $metaReview = [];
        if (!empty($all_stats)) {
            $all_stats = json_decode($all_stats, true);
            $total_point = 0;
            foreach ($all_stats as $key => $value) {
                if (isset($review_stats[$value['title']])) {
                    $total_point += $review_stats[$value['title']];
                }
                $metaReview[] = [
                    "object_id"    => $row->id,
                    "object_model" => $row->type,
                    "name"         => $value['title'],
                    "val"          => $review_stats[$value['title']] ?? 0,
                ];
            }
            $rate = round($total_point / count($all_stats), 1);
            if ($rate > 5) {
                $rate = 5;
            }
        } else {
            $rate = min(5,$request->input('review_rate'));
            $rate = max(0,$rate);
        }
        $review = new Review([
            "object_id"    => $row->id,
            "object_model" => $row->type,
            "title"        => $request->input('review_title'),
            "content"      => $request->input('review_content'),
            "rate_number"  => $rate ?? 0,
            "author_ip"    => $request->ip(),
            "status"       => !$row->getReviewApproved() ? "approved" : "pending",
            'vendor_id'    => $row->author_id,
            'author_id'    => Auth::id(),
        ]);
        if ($review->save()) {
            if (!empty($metaReview)) {
                foreach ($metaReview as $meta) {
                    $meta['review_id'] = $review->id;
                    $reviewMeta = new ReviewMeta($meta);
                    $reviewMeta->save();
                }
            }
            $msg = __('Review success!');
            if ($row->getReviewApproved()) {
                $msg = __("Review success! Please wait for admin approved!");
            }
            $row->updateServiceRate();
            return $this->sendSuccess(new ReviewResource($review),$msg);
        }
        return $this->sendError(__("Can not save review"),['code'=>500]);
    }
}
