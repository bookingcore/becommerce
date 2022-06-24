<?php


namespace Themes\Base\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\News\Models\News;
use Modules\Product\Models\Product;
use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;

class ReviewController extends Controller
{

    protected $review;
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function store(Request $request)
    {
        /**
         * @var Product $module
         */
        $news = (new News());
        $service_type = $request->input('review_service_type');
        $service_id = $request->input('review_service_id');
        $allServices = get_services();
//        add more news to list review
        $allServices[$news->type]=get_class($news);

        if (empty($allServices[$service_type])) {
            return redirect()->to(url()->previous() . '#review-form')->with('error', __('Service type not found'));
        }

        $module_class = $allServices[$service_type];

        $module = $module_class::find($service_id);
        if(empty($module)){
            return redirect()->to(url()->previous() . '#review-form')->with('error', __('Service not found'));
        }

        $reviewEnable = $module->getReviewEnable();
        if (!$reviewEnable) {
            return redirect()->to(url()->previous() . '#review-form')->with('error', __('Review not enable'));
        }

        if($module->isReviewRequirePurchase() and !$module->isBought()){
            return redirect()->to(url()->previous() . '#review-form')->with('error', __('You need to purchase a service to write a review'));
        }

//        if ($module->author_id == Auth::id()) {
//            return redirect()->to(url()->previous() . '#review-form')->with('error', __('You cannot review your service'));
//        }

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
            return redirect()->to(url()->previous() . '#review-form')->withErrors($validator->errors());
        }
        if($this->review::addReview($request,$module,$service_type,$service_id)){
            $msg = __('Review success!');
            if ($module->getReviewApproved()) {
                $msg = __("Review success! Please wait for admin approved!");
            }
            return redirect()->to(url()->previous() . '#bravo-reviews')->with('success', $msg);
        }
        return redirect()->to(url()->previous() . '#review-form')->with('error', __('Review error!'));
    }

}
