<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Illuminate\Support\Str;
use Modules\News\Models\TagTranslation;
use Modules\Product\Models\ProductTag;

class TagController extends AdminController
{
    public function __construct()
    {
        AdminMenuManager::setActive('product');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('product_manage_others');

        $tagname = $request->query('s');
        $taglist = ProductTag::query() ;
        if ($tagname) {
            $taglist->where('name', 'LIKE', '%' . $tagname . '%');
        }
        $taglist->orderby('name', 'asc');
        $data = [
            'rows'        => $taglist->paginate(20),
            'row'    => new ProductTag(),
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => 'admin/module/product'
                ],
                [
                    'name'  => __('Tag'),
                    'class' => 'active'
                ],
            ],
            'translation'=>new TagTranslation()
        ];
        return view('Product::admin.tag.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('product_manage_others');
        $row = ProductTag::find($id);
        if (empty($row)) {
            return redirect('admin/module/product/tag');
        }

        $data = [
            'row'     => $row,
            'translation'=>$row->translate($request->query('lang')),
            'parents' => ProductTag::get(),
            'enable_multi_lang'=>true
        ];
        return view('Product::admin.tag.detail', $data);
    }

    public function store(Request $request, $id){

        $this->checkPermission('product_manage_others');

        if($id>0){
            $row = ProductTag::find($id);
            if (empty($row)) {
                return redirect(route('product.admin.tag.index'));
            }
        }else{
            $row = new ProductTag();
//            $row->status = "publish";
        }

        $row->fill($request->input());
        $res = $row->saveWithTranslation($request->input('lang'));

        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Tag updated') );
            }else{
                return redirect(route('product.admin.tag.index'))->with('success', __('Tag Created') );
            }
        }
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('product_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an Action!'));
        }
        if ($action == 'delete') {
            foreach ($ids as $id) {
                ProductTag::where("id", $id)->first()->delete();
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
