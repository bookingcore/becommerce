<?php


namespace Themes\demus\Controllers\Vendor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\Product;
use Modules\Vendor\VendorMenuManager;
use Themes\demus\Controllers\FrontendController;
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
        if (!empty($search_name = $request->input('s'))) {
            $search_name = "%".$search_name."%";
            $query->whereRaw(" ( title LIKE ? OR author_ip LIKE ? OR content LIKE ? ) ",[$search_name,$search_name,$search_name]);
            $query->orderBy('title', 'asc');
        }
        $data = [
            'rows'=>$query->paginate(20),
            'page_title'=>__("Manage Reviews"),
        ];

        return view('vendor.review.index',$data);
    }
}
