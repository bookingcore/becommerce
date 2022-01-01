<?php


namespace Themes\Base\Controllers\Vendor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Models\Attributes;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
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

    public function edit(Request $request,$id){
        $this->checkPermission('product_update');
        $user_id = Auth::id();
        $row = Product::where("author_id", $user_id);
        $row = $row->find($id);
        if (empty($row)) {
            return redirect(route('vendor.product'))->with('warning', __('Product not found!'));
        }
        $translation = $row->translate($request->query('lang'));
        $data = [
            'translation'    => $translation,
            'row'           => $row,
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Products'),
                    'url'  => route('vendor.product')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Edit Product"),
            'tabs' => get_admin_product_tabs(),
            'categories'  => ProductCategory::get()->toTree(),
            "selected_terms" => $row->terms->pluck('term_id'),
            'attributes'     => Attributes::query()->where('service', 'product')->get(),
            'product'=>$row
        ];
        return view('vendor.product.detail', $data);
    }
}
