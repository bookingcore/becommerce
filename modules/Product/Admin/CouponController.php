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
use Modules\Product\Models\ProductTag;
use Modules\News\Models\Tag;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductTranslation;
use Modules\Product\Models\ProductVariation;

class CouponController extends AdminController
{
    protected $product;
    protected $product_translation;
    protected $product_term;
    protected $attributes;
    protected $variable_product;
    /**
     * @var ProductCategoryRelation
     */
    protected $product_cat_relation;

    protected $coupon;

    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('coupon');
        $this->product = Product::class;
        $this->product_translation = ProductTranslation::class;
        $this->product_term = ProductTerm::class;
        $this->attributes = Attribute::class;
        $this->product_cat_relation = ProductCategoryRelation::class;
        $this->variable_product = ProductVariation::class;
    }

    public function index(Request $request)
    {
        $query = $this->coupon::query() ;
        $query->orderBy('id', 'desc');
        if (!empty($coupon_name = $request->input('s'))) {
            $query->where('name', 'LIKE', '%' . $coupon_name . '%');
            $query->orderBy('name', 'asc');
        }

        if ($this->hasPermission('product_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with(['author'])->paginate(20),
            'breadcrumbs'        => [
                [
                    'name' => __('Products'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Coupon'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Product::admin.coupon.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('product_create');
        $row = new $this->coupon();
        $row->status = 'draft';
        $row->save();
        $row->create_user = Auth::id();
        return \redirect()->to(route('product.coupon.edit',['id'=>$row->id]));
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('product_update');
        $row = $this->coupon::find($id);
        if (empty($row)) {
            return redirect(route('product.coupon.index'));
        }
        /*$translation = $row->translate($request->query('lang'));
        if (!$this->hasPermission('product_manage_others')) {
            if ($row->create_user != Auth::id()) {
                return redirect(route('product.admin.index'));
            }
        }*/
        $data = [
            'row'            => $row,
//            'translation'    => $translation,
//            "selected_terms" => $row->terms->pluck('term_id'),
//            'attributes'     => $this->attributes::where('service', 'product')->get(),
//            'enable_multi_lang'=>true,
            'breadcrumbs'    => [
                [
                    'name' => __('Products'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Edit Coupon'),
                    'class' => 'active'
                ],
            ],
//            'categories'  => ProductCategory::get()->toTree(),
            'page_title'=>__("Edit: :name",['name'=>$row->name]),
//            'product'=>$row
        ];

        return view('Product::admin.coupon.detail', $data);
    }

    public function store( Request $request, $id ){
        if($id>0){
            $this->checkPermission('product_update');
            $row = $this->coupon::find($id);
            if (empty($row)) {
                return redirect(route('product.admin.coupon.index'));
            }

            if($row->create_user != Auth::id() and !$this->hasPermission('product_manage_others'))
            {
                return redirect(route('product.admin.index'));
            }
        }else{
            $this->checkPermission('product_create');
            $row = new $this->coupon();
            $row->status = "publish";
        }
        $newCoupon = [
            "name" => $request->input('name'),
            "coupon_type" => $request->input('coupon_type'),
            "code" => $request->input('code'),
            "url" => $request->input('url'),
            "discount" => $request->input('discount'),
            "description" => $request->input('description'),
            "expiration" => $request->input('expiration'),
            "status" => $request->input('status'),
            "email" =>  (!empty($request->input('email'))) ? json_encode($request->input('email')) : '',
            "customer_id"   => (!empty($request->input('vendor_id'))) ? json_encode($request->input('vendor_id')) : '',
            "per_coupon"    =>  $request->input('per_coupon'),
            "per_user"    =>  $request->input('per_user'),
        ];
        $dataKeys = [
            'name',
            'coupon_type',
            'discount',
            'expiration',
            'email',
            'status',
            'customer_id',
            'per_coupon',
            'per_user'
        ];
        if($this->hasPermission('product_manage_others')){
            $dataKeys[] = 'create_user';
        }

        $row->fillByAttr($dataKeys,$newCoupon);

        $res = $row->saveWithTranslation($request->input('lang'));

        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Product updated') );
            }else{
                return redirect(route('product.admin.edit',$row->id))->with('success', __('Product created') );
            }
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
                foreach ($ids as $id) {
                    $query = $this->coupon::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('product_delete');
                    }
                    $query->first()->delete();
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "clone":
                $this->checkPermission('product_create');
                foreach ($ids as $id) {
                    (new $this->coupon())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->coupon::where("id", $id);
                    if (!$this->hasPermission('product_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('product_update');
                    }
                    $query->update(['status' => $action]);
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }
}
