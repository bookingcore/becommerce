<?php


namespace Modules\Vendor\Admin;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\User\Admin\UserController;
use Modules\User\Events\VendorApproved;
use Modules\User\Exports\UserExport;
use Modules\User\Models\Role;
use Modules\Vendor\Models\VendorRequest;

class VendorController extends UserController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('vendor');
    }

    public function index(Request $request)
    {
        $this->checkPermission('vendor_view');
        $username = $request->query('s');
        $listUser = User::query()->where('role_id',3)->orderBy('id','desc');
        if (!empty($username)) {
            $listUser->where(function($query) use($username){
                $query->where('first_name', 'LIKE', '%' . $username . '%');
                $query->orWhere('id',  $username);
                $query->orWhere('phone',  $username);
                $query->orWhere('email', 'LIKE', '%' . $username . '%');
                $query->orWhere('first_name', 'LIKE', '%' . $username . '%');
                $query->orWhere('last_name', 'LIKE', '%' . $username . '%');
                $query->orWhere('business_name', 'LIKE', '%' . $username . '%');
            });
        }
        $data = [
            'rows' => $listUser->with(['role'])->paginate(20),
            'roles' => Role::all()
        ];
        return view('Vendor::admin.index', $data);
    }

    public function create(Request $request)
    {

        $row = new \Modules\User\Models\User();
        $data = [
            'row' => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Vendors"),
                    'url'=>route('vendor.admin.index')
                ],
                [
                    'name'=>__("Create new Vendor"),
                ],
            ],
            'page_title'=>__("Create new Vendor"),
            'user_type'=>'vendor',
        ];
        return view('User::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $row = User::find($id);
        if (empty($row)) {
            return redirect(route('vendor.admin.index'));
        }
        if ($row->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
            abort(403);
        }
        $data = [
            'row'   => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Vendors"),
                    'url'=>route('vendor.admin.index')
                ],
                [
                    'name'=>__("Edit Vendor: #:id",['id'=>$row->id]),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Edit Vendor: #:id",['id'=>$row->id]),
            'user_type'=>'vendor',
        ];
        return view('User::admin.detail', $data);
    }



    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = User::select('*');
        if ($q) {
            $query->where(function ($query) use ($q) {
                $query
                    ->where('email', 'like', '%' . $q . '%')
                    ->orWhere('business_name', 'like', '%' . $q . '%')
                    ->orWhere('id', $q)
                    ->orWhere('phone', 'like', '%' . $q . '%');
            });
        }
        $res = $query->where('role_id',3)->orderBy('id', 'desc')->orderBy('business_name', 'asc')->limit(20)->get();
        $data = [];
        if (!empty($res)) {
            foreach ($res as $item) {
                $data[] = [
                    'id'   => $item->id,
                    'text' => $item->display_name ? $item->display_name . ' (#' . $item->id . ')' : $item->email . ' (#' . $item->id . ')',
                ];
            }
        }
        return response()->json([
            'results' => $data
        ]);
    }

    public function export(Request $request){
        return (new UserExport(3))->download('vendor-' . date('M-d-Y') . '.xlsx');
    }
}
