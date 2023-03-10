<?php
namespace Modules\Page\Admin;

use Modules\Page\Hook;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Page\Models\Page;
use Modules\Page\Models\PageTranslation;
use Modules\Template\Models\Template;

class PageController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('page');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission("page_manage");
        $page_name = $request->query('s');
        $datapage = new Page();
        if ($page_name) {
            $datapage = Page::where('title', 'LIKE', '%' . $page_name . '%');
        }
        $datapage = $datapage->orderBy('title', 'asc');
        $data = [
            'rows'        => $datapage->with(['author'])->paginate(20),
            'page_title'=>__("Page Management"),
            'breadcrumbs' => [
                [
                    'name' => __('Pages'),
                    'url'  => route('page.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Page::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission("page_manage");
        $row = new Page();
        $row->fill([
            'status' => 'publish',
        ]);

        $data = [
            'row'         => $row,
            'translation'=>new PageTranslation(),
            'page_title'=>__("Create Page"),
            'breadcrumbs' => [
                [
                    'name' => __('Pages'),
                    'url'  => route('page.admin.index')
                ],
                [
                    'name'  => __('Add Page'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Page::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission("page_manage");

        $row = Page::find($id);

        if (empty($row)) {
            return redirect(route('page.admin.index'));
        }
        $translation = $row->translate($request->query('lang'));

        $data = [
            'translation'  => $translation,
            'row'            =>$row,
            'breadcrumbs' => [
                [
                    'name' => __('Pages'),
                    'url'  => route('page.admin.index')
                ],
                [
                    'name'  => __('Edit Page'),
                    'class' => 'active'
                ],
            ],
            'enable_multi_lang'=>true,
            'page_title'=>__("Edit page: :name",['name'=>$row->title])
        ];
        return view('Page::admin.detail', $data);
    }

    public function toBuilder($id){
        $row = Page::find($id);

        if (empty($row)) {
            return redirect(route('page.admin.index'));
        }
        if(!$row->template){
            $temp = new Template(
                [
                    'title'=>$row->title
                ]
            );
            $temp->save();
            $row->template_id = $temp->id;
        }
        $row->show_template = 1;
        $row->save();

        return redirect(route('template.admin.edit',['id'=>$row->template_id,'ref'=>'page']));
    }

    public function store(Request $request, $id){
        if(is_demo_mode()){
            return back()->with('danger',  __('DEMO Mode: You can not do this') );
        }
        $request->validate([
            'title'=>'required'
        ]);
        if($id>0){
            $this->checkPermission('page_manage');
            $row = Page::find($id);
            if (empty($row)) {
                return redirect(route('page.admin.index'));
            }
        }else{
            $this->checkPermission('page_manage');
            $row = new Page();
        }
        $n_request = $request->input();
        $row->fill($n_request);
        $row->show_template = $request->input('show_template');
        $row->author_id = $request->input('author_id',\auth()->id());

        $row->saveWithTranslation($request->query('lang'));
        $row->saveSEO($request,$request->query('lang'));

        do_action(Hook::AFTER_SAVING,$row,$request);

        if($id > 0 ){
            return back()->with('success',  __('Page updated') );
        }else{
            return redirect()->route('page.admin.edit',['id'=>$row->id])->with('success', $id > 0 ?  __('Page updated') : __('Page created'));
        }
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Page::select('id', 'title as text');
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('No Action is selected!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Page::where("id", $id);
                if (!$this->hasPermission('page_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('page_delete');
                }
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = Page::where("id", $id);
                if (!$this->hasPermission('page_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('page_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }
}
