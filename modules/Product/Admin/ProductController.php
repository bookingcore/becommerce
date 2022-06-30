<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/30/2019
 * Time: 1:56 PM
 */
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Models\Attribute;
use Modules\Media\Models\MediaFile;
use Modules\Product\Hook;
use Modules\Product\Models\Downloadable\DownloadFile;
use Modules\Product\Models\ProductGrouped;
use Modules\Product\Models\ProductTag;
use Modules\News\Models\Tag;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTagRelation;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductTranslation;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Resources\ProductResource;
use Modules\Product\Traits\Store\ProductStore;

class ProductController extends AdminController
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
        AdminMenuManager::setActive('product');
        $this->product = $product;
        $this->product_translation = ProductTranslation::class;
        $this->product_term = ProductTerm::class;
        $this->attributes = Attribute::class;
        $this->product_cat_relation = ProductCategoryRelation::class;
        $this->product_tag_relation = ProductTagRelation::class;
        $this->variable_product = ProductVariation::class;
        $this->product_grouped = $product_grouped;
    }

    public function index(Request $request)
    {
        $this->checkPermission('product_view');
        $query = $this->product::query() ;
        $query->orderBy('id', 'desc');
        if (!empty($product_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $product_name . '%');
            $query->orderBy('title', 'asc');
        }

        if ($this->hasPermission('product_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('author_id', $author);
            }
        } else {
            $query->where('author_id', Auth::id());
        }
        $data = [
            'rows'               => $query->with(['author','categories'])->paginate(20),
            'product_manage_others' => $this->hasPermission('product_manage_others'),
            'breadcrumbs'        => [
                [
                    'name' => __('Products'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Product Management")
        ];
        return view('Product::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('product_create');
        $row = new Product();
        $translation = new ProductTranslation();
        $data = [
            'row'            => $row,
            'translation'    => $translation,
            "selected_terms" => [],
            'attributes'     => $this->attributes::where('service', 'product')->get(),
            'enable_multi_lang'=>true,
            'breadcrumbs'    => [
                [
                    'name' => __('Products'),
                    'url'  => route('product.admin.index')
                ],
                [
                    'name'  => __('Create Product'),
                    'class' => 'active'
                ],
            ],
            'categories'  => ProductCategory::get()->toTree(),
            'page_title'=>__('Create Product'),
            'product'=>$row
        ];

        return view('Product::admin.detail', $data);

    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('product_update');
        $row = $this->product::find($id);
        if (empty($row)) {
            return redirect(route('product.admin.index'));
        }
        $translation = $row->translate($request->query('lang'));
        if (!$this->hasPermission('product_manage_others')) {
            if ($row->author_id != Auth::id()) {
                return redirect(route('product.admin.index'));
            }
        }

        $data = [
            'row'            => $row,
            'translation'    => $translation,
            "selected_terms" => $row->terms->pluck('term_id'),
            'attributes'     => $this->attributes::where('service', 'product')->get(),
            'enable_multi_lang'=>true,
            'breadcrumbs'    => [
                [
                    'name' => __('Products'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Edit Product'),
                    'class' => 'active'
                ],
            ],
            'categories'  => ProductCategory::get()->toTree(),
            'page_title'=>__("Edit: :name",['name'=>$row->title]),
            'product'=>$row
        ];

        return view('Product::admin.detail', $data);
    }

    public function store( Request $request, $id ){

        if(is_demo_mode()){
            return back()->with('danger',  __('DEMO Mode: You can not do this') );
        }
        $request->validate([
            'title'=>'required'
        ],[
            'title.required'=>__("Product name is required")
        ]);

        if($id>0){
            $this->checkPermission('product_update');
            $row = $this->product::find($id);
            if (empty($row)) {
                return redirect(route('product.admin.index'));
            }

            if($row->author_id != Auth::id() and !$this->hasPermission('product_manage_others'))
            {
                return redirect(route('product.admin.index'));
            }
        }else{
            $this->checkPermission('product_create');
            $row = new $this->product();
        }
        $dataKeys = [
            'title',
            'content',
            'short_desc',
            'slug',
            'status',
            'image_id',
            'gallery',
            'price',
            'origin_price',
            'is_featured',
            'brand_id',
            'product_type',
            'attributes_for_variation',
            'sku',
            'is_manage_stock',
            'stock_status',
            'quantity',
            'button_text',
            'external_url',
            'is_approved',
            'downloadable',
            'download_expiry_days'
        ];
        if($this->hasPermission('product_manage_others')){
            $dataKeys[] = 'author_id';
        }

        $dataKeys = apply_filters(Hook::SAVING_KEYS,$dataKeys);

        $row->fillByAttr($dataKeys,$request->input());
        if(!$row->author_id) $row->author_id = auth()->id();
        $row->updateMinMaxPrice();
        if(!empty($row->is_manage_stock) and $row->quantity > 0){
             $row->stock_status = 'in';
        }

        $res = $row->saveWithTranslation($request->input('lang'));

        $row->saveSEO($request,$request->input('lang'));

        if ($res) {
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
            }else{
                return redirect(route('product.admin.edit',$row->id))->with('success', __('Product created') );
            }
        }
    }

    public function ajaxSaveTerms(Request $request){

        $product_id = request()->input('product_id');
        if(empty($product_id))
        {
            return $this->sendError(__("Product id is required"));
        }
        $query = Product::where('id',$product_id);
        if(!$this->hasPermission('product_manage_others')){
            $query->where('create_user',Auth::id());
        }
        $product = $query->first();

        if(empty($product))
        {
            return $this->sendError(__("Product not found"));
        }

        $product->attributes_for_variation = $request->input('attributes_for_variation');
        $product->save();

        $this->saveTerms($product,$request);

        return $this->sendSuccess([],__('Attribute data saved'));
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }

        switch ($action){
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->product::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("author_id", Auth::id());
                        $this->checkPermission('product_delete');
                    }
                    $query->first()->delete();
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "clone":
                $this->checkPermission('product_create');
                foreach ($ids as $id) {
                    (new $this->product())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->product::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("author_id", Auth::id());
                        $this->checkPermission('product_update');
                    }
                    $data =['status' => $action];

                    if(in_array($action,['rejected','pending'])){
                        $data['is_approved'] = 0;
                    }
                    if(in_array($action,['publish'])){
                        $data['is_approved'] = 1;
                    }
                    $query->update($data);
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }

    public function getForSelect2(Request $request){
        $query = Product::query()->orderBy('title')->where('status','publish');

        if($s = $request->query('s')){
            $query->where('title','like','%'.$s.'%');
        }

        if($s = $request->query('not_in_ids',[])){
            $query->whereNotIn('id',$s);
        }


        return ProductResource::collection($query->paginate(10),array_merge(['variations'],$request->query('need',[])));
    }
}
