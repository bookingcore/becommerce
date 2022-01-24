<?php


namespace Themes\Base\Controllers\Vendor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\Product;
use Modules\Vendor\VendorMenuManager;
use Themes\Base\Controllers\FrontendController;
use Modules\Review\Models\Review;

class ReviewController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        VendorMenuManager::setActive('review');
    }

    public function index(Request $request){

        $query = Review::query();
        $query->where('vendor_id',auth()->id())->orderBy('id', 'desc');
        $data = [
            'rows'=>$query->paginate(20),
            'page_title'=>__("Manage Reviews"),
            'page_subtitle'=>__('Product Listings')
        ];

        return view('vendor.review.index',$data);
    }
}
