<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductBrandTranslation;

class BrandController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('product');
    }

    public function index(Request $request)
    {
        $this->checkPermission('product_manage_others');
        $list = ProductBrand::query();
        if (!empty($search = $request->query('s'))) {
	        $list->where('name', 'LIKE', '%' . $search . '%');
        }
	    $list->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $list->get(),
            'row'         => new ProductBrand(),
            'translation'    => new ProductBrandTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Brand'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Add Brand:")
        ];
        return view('Product::admin.brand.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('product_manage_others');
        $row = ProductBrand::find($id);
        if (empty($row)) {
            return redirect(route('product.admin.brand.index'));
        }
        $translation = $row->translate($request->query('lang'));
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Brand'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Edit Brand: :name",['name'=>$translation->name])
        ];
        return view('Product::admin.brand.detail', $data);
    }

    public function store(Request $request , $id)
    {
        $this->checkPermission('product_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        if($id>0){
            $row = ProductBrand::find($id);
            if (empty($row)) {
                return redirect(route('product.admin.category.index'));
            }
        }else{
            $row = new ProductBrand();
            $row->status = "publish";
        }

        $row->fillByAttr([
            'name','content','image_id'
        ],$request->input());
        $res = $row->saveWithTranslation($request->input('lang'));
        $row->saveSEO($request,$request->input('lang'));

        if ($res) {
            return back()->with('success',  __('Brand saved') );
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
                $query = ProductBrand::where("id", $id);
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = ProductBrand::where("id", $id);
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
            $item = ProductBrand::find($selected);
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
        $query = ProductBrand::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
