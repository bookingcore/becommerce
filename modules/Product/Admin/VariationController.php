<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/4/2019
 * Time: 3:32 PM
 */
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Models\VariableProduct;
use Modules\Product\Models\ProductVariationTerm;

class VariationController extends AdminController
{
    protected $product_variation;
    protected $product;
    protected $product_class;
    protected $variable_product;

    public function __construct()
    {
        parent::__construct();
        $this->product_variation = ProductVariation::class;
        $this->product_class = Product::class;
        $this->variable_product = VariableProduct::class;
        $this->product_variation_term = ProductVariationTerm::class;
    }

    protected function validateProductPermission($id){
        if(empty($id)) return false;

        $this->product = $this->product_class::find($id);

        if(empty($this->product)) return false;

        if(!$this->hasPermission('product_update')) return false;

        if(!$this->hasPermission('product_manage_others') and $this->product->create_user != Auth::id()){
            return false;
        }

        return true;
    }

    public function index($id){

        if(!$this->validateProductPermission($id))
        {
            abort(403);
        }
        $data = [
            'breadcrumbs'    => [
                [
                    'name' => __('Products'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Product: :name',['name'=>$this->product->title]),
                    'url'  => 'admin/module/product',
                ],
                [
                    'name'  => __('Variations'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Manage Variations for :name",['name'=>$this->product->title]),
            'product'=>$this->product
        ];
        return view('Product::admin.product.variations',$data);

    }

    public function storeAttrs($id){
        if(!$this->validateProductPermission($id))
        {
            abort(403);
        }
        $attributes_for_variation = \request()->input('attributes_for_variation',[]);
        $attributes_for_variation = array_unique($attributes_for_variation);
        $this->product->attributes_for_variation = $attributes_for_variation;
        $this->product->save();

        return $this->sendSuccess([],__("Product attribute for variations saved"));
    }


    public function ajaxVariationList($id){
        $this->checkPermission('product_update');

        $query = $this->variable_product::where("id", $id);
        if (!$this->hasPermission('product_manage_others')) {
            $query->where("create_user", Auth::id());
        }

        $product = $query->first();

        if(empty($product)) return;

        return view('Product::admin.product.ajax.variation-list',['product'=>$product]);
    }

    public function ajaxAddVariation(){

        $product_id = request()->input('id');
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

        $variation = new $this->product_variation();
        $variation->product_id = $product_id;
        $variation->active = 1;
        $variation->save();

        return $this->sendSuccess();

    }

    public function ajaxDeleteVariation(){

        $variation_id = request()->input('id');
        if(empty($variation_id))
        {
            return $this->sendError(__("Variation id is required"));
        }
        $query = ProductVariation::where('id',$variation_id);
        $var_term = ProductVariationTerm::where('variation_id',$variation_id);
        if(!$this->hasPermission('product_manage_others')){
            $query->where('create_user',Auth::id());
            $var_term->where('create_user',Auth::id());
        }
        $variation = $query->first();

        if(empty($variation))
        {
            return $this->sendError(__("Variation not found"));
        }

        $variation->delete();
        $var_term->delete();

        return $this->sendSuccess();

    }
    public function ajaxSaveVariations(){

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

        $variations = request()->input('variations');
        if(empty($variations) or !\is_array($variations))
        {
            return $this->sendError(__("Variations data is required"));
        }

        foreach($variations as $id=>$data)
        {
            if(empty($data)) continue;
            $variation = $this->product_variation::find($id);
            if(empty($variation) or $variation->product_id != $product_id) continue;

            $variation->fillByAttr([
                'image_id','sku','price','is_manage_stock','quantity','stock_status','active'
            ],$data);

            $variation->save();

            $this->saveTerms($variation,$data);
        }

        return $this->sendSuccess([],__('Variations data saved'));
    }

    protected function saveTerms($variation, $data)
    {
        if (empty($data['terms'])) {
            $this->product_variation_term::where('variation_id', $variation->id)->delete();
        } else {
            $term_ids = $data['terms'];
            foreach ($term_ids as $term_id) {
                $this->product_variation_term::firstOrCreate([
                    'term_id' => $term_id,
                    'variation_id' => $variation->id,
                    'product_id' => $variation->product_id
                ]);
            }
            $this->product_variation_term::where('variation_id', $variation->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function load(){
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

        $variations = $product->variations();

        return $this->sendSuccess([
            'rows'=>$variations
        ]);

    }

    public function store(){

        $rules  = [];

        $id = request()->input('id');

        if(empty($id)){
            $rules['product_id'] = 'required';
        }
        if(request()->input('sku')){
            $rules['sku'] = 'unique:product_variations.sku|unique:products.sku';
        }

        request()->validate($rules);

        $fillByAttr = [
            'name',
            'sku',
            'image_id',
            'weight',
            'is_manage_stock',
            'quantity',
            'price',
            'status',
            'length',
            'height',
            'width'
        ];

        if(!$id){
            $product_id = request()->input('product_id');
            $query = Product::where('id',$product_id);
            if(!$this->hasPermission('product_manage_others')){
                $query->where('create_user',Auth::id());
            }
            $product = $query->first();

            if(empty($product))
            {
                return $this->sendError(__("Product not found"));
            }

            $variation = new ProductVariation();
            $fillByAttr[] = 'product_id';
        }else{

            $query = ProductVariation::where('id',$id);
            if(!$this->hasPermission('product_manage_others')){
                $query->where('create_user',Auth::id());
            }
            $variation = $query->first();

            if(empty($variation))
            {
                return $this->sendError(__("Variation not found"));
            }
        }

        $data = request()->input();
        $dimensions = request()->input('dimensions');
        $data['length'] = $dimensions['length'] ?? '';
        $data['width'] = $dimensions['width'] ?? '';
        $data['height'] = $dimensions['height'] ?? '';

        $variation->fillByAttr($fillByAttr,$data);

        $variation->save();

        if($id){
            return $this->sendSuccess([],"Variation saved");
        }else{
            return $this->sendSuccess([],"Variation created");
        }
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
                $this->checkPermission('product_delete');
                foreach ($ids as $id) {
                    $query = $this->product_variation::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("create_user", Auth::id());
                    }
                    $query->first()->delete();
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            default:
                // Change status
                $this->checkPermission('product_update');
                foreach ($ids as $id) {
                    $query = $this->product_variation::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("create_user", Auth::id());
                    }
                    $query->update(['status' => $action]);
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }
}
