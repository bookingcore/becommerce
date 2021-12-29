<?php
namespace Modules\Product\Controllers;

use Modules\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Models\Attributes;
use Modules\News\Models\Tag;
use Modules\Product\Models\Order;
use Modules\Product\Models\OrderItem;
use Modules\Product\Models\Product;


use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTag;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductTranslation;

class VendorController extends FrontendController
{
    protected $product;
    protected $product_translation;
    protected $product_term;
    protected $product_tag;
    protected $product_cat_relation;
    protected $attributes;

    public function __construct()
    {
        parent::__construct();
        $this->product = Product::class;
        $this->product_translation = ProductTranslation::class;
        $this->product_term = ProductTerm::class;
        $this->product_tag = ProductTag::class;
        $this->product_cat_relation = ProductCategoryRelation::class;
        $this->attributes = Attributes::class;
        $this->setActiveMenu(route('product.vendor.index'));
    }

    public function manage(Request $request)
    {
        $user_id = Auth::id();
        $rows = $this->product::where("create_user", $user_id)->orderBy('id', 'desc');
        $data = [
            'rows' => $rows->paginate(20),
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Products'),
                    'url'  => route('product.vendor.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Manage Products"),
        ];
        return view('Product::frontend.vendor.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('product_create');
        $row = new $this->product();
        $row->status = 'draft';
        $row->save();
        $row->create_user = Auth::id();
        return \redirect()->to(route('product.vendor.edit',['id'=>$row->id,'action'=>'draft_create']));
    }


    public function store( Request $request, $id ){

        if($id>0){
            $this->checkPermission('product_update');
            $row = $this->product::find($id);
            if (empty($row)) {
                return redirect(route('product.vendor.index'));
            }

            if($row->create_user != Auth::id() and !$this->hasPermission('product_manage_others'))
            {
                return redirect(route('product.vendor.index'));
            }
        }else{
            $this->checkPermission('product_create');
            $row = new $this->product();
            $row->status = "draft";
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
            'sale_price',
            'is_featured',
            'brand_id',
            'product_type',
            'attributes_for_variation',
            'sku',
            'is_manage_stock',
            'stock_status',
            'quantity',
        ];
        if(!is_admin()){
            unset($dataKeys['is_featured']);
        }
        if($this->hasPermission('product_manage_others')){
            $dataKeys[] = 'create_user';
        }

        $row->fillByAttr($dataKeys,$request->input());

        $res = $row->saveOriginOrTranslation($request->input('lang'),true);

        if ($res) {
            if(!$request->input('lang') or is_default_lang($request->input('lang'))) {
                $this->saveTags($row, $request->input('tag_name'), $request->input('tag_ids'));
                $this->saveCategory($row, $request);
                $this->saveTerms($row, $request);
            }

            if($id > 0 ){
                return back()->with('success',  __('Product updated') );
            }else{
                return redirect(route('product.vendor.edit',['id'=>$row->id]))->with('success', __('Product created') );
            }
        }
    }
    public function saveCategory($row, $request){
        if (empty($request->input('category_ids'))) {
            $this->product_cat_relation::query()->where('target_id',$row->id)->delete();
        } else {
            $term_ids = $request->input('category_ids');
            foreach ($term_ids as $term_id) {
                $this->product_cat_relation::firstOrCreate([
                    'cat_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            $this->product_cat_relation::where('target_id', $row->id)->whereNotIn('cat_id', $term_ids)->delete();
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->product_term::where('target_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->product_term::firstOrCreate([
                    'term_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            $this->product_term::where('target_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }
    public function saveTags($row, $tags_name, $tag_ids)
    {
        if (empty($tag_ids))
            $tag_ids = [];
        $tag_ids = array_merge(Tag::saveTagByName($tags_name), $tag_ids);
        $tag_ids = array_filter(array_unique($tag_ids));
        // Delete unused
        $this->product_tag::whereNotIn('tag_id', $tag_ids)->where('target_id', $row->id)->delete();
        //Add
        $this->product_tag::addTag($tag_ids, $row->id);

    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('product_update');
        $user_id = Auth::id();
        $row = $this->product::where("create_user", $user_id);
        $row = $row->find($id);
        if (empty($row)) {
            return redirect(route('product.vendor.index'))->with('warning', __('Product not found!'));
        }
        $translation = $row->translate($request->query('lang'));
        $data = [
            'translation'    => $translation,
            'row'           => $row,
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Products'),
                    'url'  => route('product.vendor.index')
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
            'attributes'     => $this->attributes::where('service', 'product')->get(),
            'product'=>$row
        ];
        return view('Product::frontend.vendor.detail', $data);
    }

    public function delete($id)
    {
        $this->checkPermission('product_delete');
        $user_id = Auth::id();
        $this->product::where("create_user", $user_id)->where("id", $id)->first()->delete();
        return redirect(route('product.vendor.list'))->with('success', __('Delete product success!'));
    }



    public function orders(){
        $user_id = Auth::id();
        $orders = Order::select('product_orders.*','product_order_items.vendor_id')->join('product_order_items','product_orders.id','=','product_order_items.order_id')->where('product_order_items.vendor_id',$user_id)->where('product_orders.status','<>','draft')->groupBy('product_orders.id')->orderBy('product_orders.id','desc')->paginate(10);
        $data = [
            'user_id' => $user_id,
            'orders'   => $orders,
            'statues'  => config('booking.statuses'),
            'breadcrumbs'        => [
                [
                    'name' => __('Product\'s Order'),
                    'class' => 'active'
                ]
            ],
            'page_title'         => __("Product's Order"),
        ];
        return view('Product::frontend.vendor.products-order', $data);
    }


    public function orderDetail(Request $request, $id){
        $order = Order::where('id',$id)->first();
        $suborder = OrderItem::where('order_id',$id)->whereIn('id',$request->post('suborder'))->get();
        $data = [
            'id' => $id,
            'order' => $order,
            'suborder' => $suborder,
        ];
        if (boolval($request->post('products_order')) != true){
            return view('User::frontend.order.order-modal',$data)->render();
        } else {
            return view('Product::frontend.vendor.order-modal',$data)->render();
        }

    }
}
