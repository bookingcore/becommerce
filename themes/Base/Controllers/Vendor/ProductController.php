<?php


namespace Themes\Base\Controllers\Vendor;


use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Vendor\VendorMenuManager;
use Themes\Base\Controllers\FrontendController;

class ProductController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        VendorMenuManager::setActive('product');
    }

    public function index(Request $request){
        $this->checkPermission('product_view');
        $query = Product::query()->ofVendor(auth()->user());

        if($s = $request->query('s'))
        {
            $query->where('title','like','%'.$s.'%');
        }
        if($s = $request->query('status'))
        {
            $query->where('status',$s);
        }
        $data = [
            'rows'=>$query->orderByDesc('id')->paginate(20),
            'page_title'=>__("Manage Products"),
            'page_subtitle'=>__('Product Listings')
        ];

        return view('vendor.product.index',$data);
    }
}
