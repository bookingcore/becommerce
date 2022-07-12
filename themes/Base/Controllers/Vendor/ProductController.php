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
use Modules\Product\Models\Vendor\ProductVendor;
use Modules\Product\Traits\Store\ProductStore;
use Modules\Vendor\Models\Vendor;
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
        $filters = $request->query();
        $filters['vendor'] = auth()->user();

        $query = Product::search(
            $filters
        );

        $data = [
            'rows'=>$query->with(['categories','current_product_vendor'])->orderByDesc('id')->paginate(20),
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

        $user = auth()->user();
        if($user->getVendorMode() == Vendor::MODE_EXIST_ONLY){
            return redirect(route('vendor.product'))->with('danger',  __('You are only available to sell exist products') );
        }

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

        $user = auth()->user();
        if($user->getVendorMode() == Vendor::MODE_EXIST_ONLY){
            return redirect(route('vendor.product'))->with('danger',  __('You are only available to sell exist products') );
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
            'downloadable',
            'download_expiry_days',
            'is_virtual',
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
        $query = Product::query()->where("id", $id)->first();
        if($query->author_id == auth()->id()) {
            if (!empty($query)) {
                $query->delete();
            }
        }else{
            if($query->current_product_vendor){
                $query->current_product_vendor->delete();
            }
        }
        return redirect(route('vendor.product'))->with('success', __('Delete product success!'));
    }

    public function search(Request $request){

        $filters = $request->query();

        $rows = Product::search([
            'type_in'=>[
                'simple','variable'
            ],
            'not_vendor_id'=>auth()->id()
        ]);

        $data = [
            'page_title'=>__("Search for products to start selling"),
            'rows'=>!empty($filters) ? $rows->paginate(20) : []
        ];

        return view('vendor.product.sell.search',$data);
    }

    public function sell(Product $product){
        $user = auth()->user();
        if($user->getVendorMode() == Vendor::MODE_NEW_ONLY){
            return redirect(route('vendor.product'))->with('danger',__("Only allow add new product"));
        }
        if(!in_array($product->product_type,['simple','variable']) or $product->author_id == auth()->id()){
            return redirect(route('vendor.product'))->with('danger',__("This product type are not allowed to sell"));
        }

        $product_vendor = ProductVendor::query()->firstOrNew([
            'vendor_id'=>$user->id,
            'product_id'=>$product->id
        ]);

        $data = [
            'page_title'=>__("Sell product :name",['name'=>$product->title]),
            'row'=>$product,
            'product_vendor'=>$product_vendor
        ];

        return view('vendor.product.sell.detail',$data);
    }
    public function sellStore(Product $product,Request $request){
        $user = auth()->user();
        if($user->getVendorMode() == Vendor::MODE_NEW_ONLY){
            return redirect(route('vendor.product'))->with('danger',__("Only allow add new product"));
        }
        if(!in_array($product->product_type,['simple','variable']) or $product->author_id == auth()->id()){
            return redirect(route('vendor.product'))->with('danger',__("This product type are not allowed to sell"));
        }

        $rules = [
            'price'=>'required',
            'quantity'=>'required|min:0',
        ];

        $request->validate($rules);

        $data = [
            'price'=>$request->input('price'),
            'active'=>$request->input('active'),
            'sku'=>$request->input('sku'),
            'image_id'=>$request->input('image_id'),
            'quantity'=>$request->input('quantity'),
        ];
        /**
         * @var ProductVendor $product_vendor
         */
        $product_vendor = ProductVendor::query()->firstOrNew([
            'vendor_id'=>$user->id,
            'product_id'=>$product->id
        ]);

        $product_vendor->fillByAttr(array_keys($data),$data);
        $product_vendor->save();

        switch ($product->product_type){
            case "variable":
                $input_variations = $request->input('variations',[]);
                foreach ($product->variations as $variation){
                    $input_variation  = $input_variations[$variation->id] ?? [];
                    $vendor_variation = \Modules\Product\Models\Vendor\ProductVendorVariation::firstOrNew([
                        'vendor_id'=>auth()->id(),
                        'parent_id'=>$variation->id
                    ]);
                    $data = [
                        'price'=>$input_variation['price'] ?? 0,
                        'sku'=>$input_variation['sku'] ?? '',
                        'image_id'=>$input_variation['image_id'] ?? '',
                        'active'=>$input_variation['active'] ?? '',
                        'quantity'=>$input_variation['quantity'] ?? 0,
                        'product_id'=>$product->id
                    ];
                    $vendor_variation->fillByAttr(array_keys($data),$data);
                    $vendor_variation->save();
                }
                break;
        }


        return back()->with('success',__("Data saved"));
    }
}
