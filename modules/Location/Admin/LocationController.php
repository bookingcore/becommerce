<?php
namespace Modules\Location\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Location\Models\Location;
use Modules\Location\Models\LocationTranslation;

class LocationController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('location');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('location_manage');
        $listLocation = Location::query() ;
        if (!empty($search = $request->query('s'))) {
            $listLocation->where('name', 'LIKE', '%' . $search . '%');
        }
        $listLocation->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $listLocation->get()->toTree(),
            'row'         => new Location(),
            'translation' => new LocationTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Location'),
                    'url'  => route('location.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Manage Store Locations")
        ];
        return view('Location::admin.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('location_manage');
        $row = Location::find($id);
        $translation = $row->translate($request->query('lang'));
        if (empty($row)) {
            return redirect(route('location.admin.index'));
        }
        $data = [
            'translation' => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => Location::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Location'),
                    'url'  => route('location.admin.index')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Edit Store Locations")
        ];
        return view('Location::admin.detail', $data);
    }

    public function store( Request $request, $id ){
        $this->checkPermission('location_manage');

        $request->validate([
            'name'=>'required',
            'address'=>'required',
        ]);

        if($id>0){
            $row = Location::find($id);
            if (empty($row)) {
                return redirect(route('location.admin.index'));
            }
        }else{
            $row = new Location();
        }

        $data  = [
            'name'=>$request->input('name'),
            'content'=>$request->input('content'),
            'address'=>$request->input('address'),
            'status'=>$request->input('status'),
            'map_lat'=>$request->input('map_lat'),
            'map_lng'=>$request->input('map_lng'),
            'map_zoom'=>$request->input('map_zoom'),
        ];
        $row->fillByAttr(array_keys($data),$data);

        $res = $row->saveWithTranslation($request->input('lang'));

        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Location updated') );
            }else{
                return redirect(route('location.admin.index',$row->id))->with('success', __('Location created') );
            }
        }
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            if(is_array($selected))
            {
                $items = Location::select('id', 'name as text')->whereIn('id',$selected)->take(50)->get();
                return response()->json([
                    'items'=>$items
                ]);
            }else{
                $item = Location::find($selected);
            }
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
        $query = Location::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
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
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __("Select at least 1 item!"));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Location::where("id", $id);
                if (!$this->hasPermission('location_manage')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('location_manage');
                }
                $query->first();
                if(!empty($query)){
                    //Sync child location
                    $list_childs = Location::where("parent_id", $id)->get();
                    if(!empty($list_childs)){
                        foreach ($list_childs as $child){
                            $child->parent_id = null;
                            $child->save();
                        }
                    }
                    //Del parent location
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Location::where("id", $id);
                if (!$this->hasPermission('location_manage')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('location_manage');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }
}