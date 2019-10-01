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

class VariationController extends AdminController
{
    protected $product_variation;
    protected $product;
    protected $product_class;

    public function __construct()
    {
        parent::__construct();
        $this->product_variation = ProductVariation::class;
        $this->product_class = Product::class;
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

    public function load(){
        $product_id = request()->input('product_id');
        if(empty($product_id))
        {
            $this->sendError(__("Product id is required"));
        }
        $query = Product::where('id',$product_id);
        if(!$this->hasPermission('product_manage_others')){
            $query->where('create_user',Auth::id());
        }
        $product = $query->first();

        if(empty($product))
        {
            $this->sendError(__("Product not found"));
        }

        $variations = $product->variations();

        $this->sendSuccess([
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
                $this->sendError(__("Product not found"));
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
                $this->sendError(__("Variation not found"));
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
            $this->sendSuccess([],"Variation saved");
        }else{
            $this->sendSuccess([],"Variation created");
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