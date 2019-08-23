<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryTranslation;

class CategoryController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/product');
    }

    public function index(Request $request)
    {
        $this->checkPermission('product_manage_others');
        $listCategory = ProductCategory::query();
        if (!empty($search = $request->query('s'))) {
            $listCategory->where('name', 'LIKE', '%' . $search . '%');
        }
        $listCategory->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listCategory->get()->toTree(),
            'row'         => new ProductCategory(),
            'translation'    => new ProductCategoryTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Add Category:")
        ];
        return view('Product::admin.category.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('product_manage_others');
        $row = ProductCategory::find($id);
        if (empty($row)) {
            return redirect(route('product.admin.category.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => ProductCategory::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Edit Category: :name",['name'=>$translation->name])
        ];
        return view('Product::admin.category.detail', $data);
    }

    public function store(Request $request , $id)
    {
        $this->checkPermission('product_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        if($id>0){
            $row = ProductCategory::find($id);
            if (empty($row)) {
                return redirect(route('product.admin.category.index'));
            }
        }else{
            $row = new ProductCategory();
            $row->status = "publish";
        }

        $row->fillByAttr([
            'name','content','image_id','parent_id'
        ],$request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'),true);

        if ($res) {
            return back()->with('success',  __('Category saved') );
        }
    }

    public function editBulk(Request $request)
    {
        $this->checkPermission('product_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = ProductCategory::where("id", $id);
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = ProductCategory::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            $item = ProductCategory::find($selected);
            if(empty($item)){
                return response()->json([
                    'text'=>''
                ]);
            }else{
                return response()->json([
                    'text'=>$item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = ProductCategory::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
