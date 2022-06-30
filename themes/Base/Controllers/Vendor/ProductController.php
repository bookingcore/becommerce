<?php


namespace Themes\Base\Controllers\Vendor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Models\Attribute;
use Modules\News\Models\Tag;
use Modules\Product\Hook;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductGrouped;
use Modules\Product\Models\ProductTag;
use Modules\Product\Models\ProductTagRelation;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductTranslation;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Traits\Store\ProductStore;
use Modules\Vendor\VendorMenuManager;
use Themes\Base\Controllers\FrontendController;

class ProductController extends FrontendController
{
    use ProductStore;

    protected $product;
    protected $product_translation;
    protected $product_term;
    protected $attributes;
    protected $variable_product;
    protected $product_grouped;
    /**
     * @var ProductCategoryRelation
     */
    protected $product_cat_relation;
    /**
     * @var ProductTagRelation
     */
    protected $product_tag_relation;

    public function __construct(Product $product,ProductGrouped $product_grouped)
    {
        parent::__construct();
        VendorMenuManager::setActive('product');
        $this->product = $product;
        $this->product_translation = ProductTranslation::class;
        $this->product_term = ProductTerm::class;
        $this->attributes = Attribute::class;
        $this->product_cat_relation = ProductCategoryRelation::class;
        $this->product_tag_relation = ProductTagRelation::class;
        $this->variable_product = ProductVariation::class;
        $this->product_grouped = $product_grouped;
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
            'rows'=>$query->with(['categories'])->orderByDesc('id')->paginate(20),
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
        if(is_demo_mode()){
            return back()->with('danger',  __('DEMO Mode: You can not do this') );
        }
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

        $row->is_approved = vendor_product_need_approve() ? 0 : 1;
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
            'external_url',
            'downloadable'
        ];
        if($row->is_approved){
            $dataKeys[] = 'status';
        }

        $dataKeys = apply_filters(Hook::SAVING_KEYS,$dataKeys);

        $row->fillByAttr($dataKeys,$request->input());

        $row->updateMinMaxPrice();
        if(!empty($row->is_manage_stock) and $row->quantity > 0){
            $row->stock_status = 'in';
        }

        $row->saveWithTranslation($request->input('lang'));

        $row->saveSEO($request,$request->input('lang'));

        if(!$request->input('lang') or is_default_lang($request->input('lang'))) {
            $this->saveTags($row, $request->input('tag_name'), $request->input('tag_ids'));
            $this->saveCategory($row, $request);
            $this->saveTerms($row, $request);
            $this->saveGroupedProducts($row, $request);
            $this->saveDownloadable($row, $request);
        }

        do_action(Hook::AFTER_SAVING,$row);

        if($id > 0 ){
            return back()->with('success',  __('Product updated') );
        }else {
            return redirect(route('vendor.product.edit', $row->id))->with('success',__("Product created"));
        }
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
}
