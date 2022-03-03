<?php


namespace Themes\Base\Controllers\Vendor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Models\Attribute;
use Modules\News\Models\Tag;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTag;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductTranslation;
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
        if($s = $request->query('product_type'))
        {
            $query->where('product_type',$s);
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
            'attributes'     => Attribute::query()->where('service', 'product')->get(),
            'product'=>$row
        ];
        return view('vendor.product.detail', $data);
    }

    public function create(Request $request){
        $this->checkPermission('product_create');
        $user_id = Auth::id();
        $row = new Product();
        $translation = new ProductTranslation();
        $data = [
            'translation'    => $translation,
            'row'           => $row,
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Products'),
                    'url'  => route('vendor.product')
                ],
                [
                    'name'  => __('Create product'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Create Product"),
            'tabs' => get_admin_product_tabs(),
            'categories'  => ProductCategory::get()->toTree(),
            "selected_terms" => [],
            'attributes'     => Attribute::query()->where('service', 'product')->get(),
            'product'=>$row
        ];
        return view('vendor.product.detail', $data);
    }

    public function store(Request $request,$id = ''){
        $request->validate([
            'title'=>'required'
        ]);

        if(!$id){
            $this->checkPermission('product_create');

            $row = new Product();
            $row->author_id = auth()->id();
        }else{
            $row = Product::query()->where('id',$id)->where('author_id',auth()->id())->first();
            if(!$row){
                abort(404);
            }
            $this->checkPermission('product_update');
        }

        if(vendor_product_need_approve() and !$row->id){
            $row->status = 'pending';
        }
        if($row->status == 'rejected'){
            $row->status = 'pending';
        }

        $dataKeys = [
            'title',
            'content',
            'short_desc',
            'slug',
            'image_id',
            'gallery',
            'price',
            'origin_price',
            'brand_id',
            'product_type',
            'attributes_for_variation',
            'sku',
            'is_manage_stock',
            'stock_status',
            'quantity',
            'button_text',
            'external_url'
        ];
        if($row->is_approved){
            $dataKeys[] = 'status';
        }
        $row->fillByAttr($dataKeys,$request->input());

        $row->saveWithTranslation($request->input('lang'));

        $row->saveSEO($request,$request->input('lang'));

        if(!$request->input('lang') or is_default_lang($request->input('lang'))) {
            $this->saveTags($row, $request->input('tag_name'), $request->input('tag_ids'));
            $this->saveCategory($row, $request);
            $this->saveTerms($row, $request);
        }

        return redirect(route('vendor.product.edit',$row->id))->with('success', $id ? __('Product updated') : __("Product created") );

    }

    public function delete($id)
    {
        $this->checkPermission('product_delete');
        $query = Product::where("author_id", auth()->id())->where("id", $id)->first();
        if (!empty($query)) {
            $query->delete();
        }
        return redirect(route('vendor.product'))->with('success', __('Delete product success!'));
    }

    public function saveTags($row, $tags_name, $tag_ids)
    {
        if (empty($tag_ids))
            $tag_ids = [];
        $tag_ids = array_merge(Tag::saveTagByName($tags_name), $tag_ids);
        $tag_ids = array_filter(array_unique($tag_ids));
        // Delete unused
        ProductTag::whereNotIn('tag_id', $tag_ids)->where('target_id', $row->id)->delete();
        //Add
        ProductTag::addTag($tag_ids, $row->id);

    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            ProductTerm::where('target_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                ProductTerm::firstOrCreate([
                    'term_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            ProductTerm::where('target_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function saveCategory($row, $request){
        if (empty($request->input('category_ids'))) {
            ProductCategoryRelation::query()->where('target_id',$row->id)->delete();
        } else {
            $term_ids = $request->input('category_ids');
            foreach ($term_ids as $term_id) {
                ProductCategoryRelation::firstOrCreate([
                    'cat_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            ProductCategoryRelation::where('target_id', $row->id)->whereNotIn('cat_id', $term_ids)->delete();
        }
    }
}
