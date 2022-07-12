<?php
namespace Modules\User\Admin;

use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\User\Events\VendorApproved;
use Modules\User\Exports\UserExport;
use Modules\User\Models\Role;
use Modules\User\Resources\UserResource;
use function League\Flysystem\Local\delete;

class UserController extends AdminController
{
    use ResetsPasswords;

    public function __construct()
    {
        AdminMenuManager::setActive('user');
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->checkPermission('user_manage');
        $username = $request->query('s');
        $listUser = User::query()->orderBy('id','desc');
        if (!empty($username)) {
             $listUser->where(function($query) use($username){
                 $query->where('first_name', 'LIKE', '%' . $username . '%');
                 $query->orWhere('id',  $username);
                 $query->orWhere('phone',  $username);
                 $query->orWhere('email', 'LIKE', '%' . $username . '%');
                 $query->orWhere('last_name', 'LIKE', '%' . $username . '%');
             });
        }
        if($request->query('role')){
            $listUser->role($request->query('role'));
        }
        $data = [
            'rows' => $listUser->with(['role'])->paginate(20),
            'roles' => Role::all()
        ];
        return view('User::admin.index', $data);
    }

    public function create(Request $request)
    {

        $row = new \Modules\User\Models\User();
        $data = [
            'row' => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Users"),
                    'url'=>'admin/module/user'
                ],
                [
                    'name'=>__("Create new User"),
                ],
            ]
        ];
        return view('User::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $row = User::find($id);
        if (empty($row)) {
            return redirect('admin/module/user');
        }
        if ($row->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
            abort(403);
        }
        $data = [
            'row'   => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Users"),
                    'url'=>'admin/module/user'
                ],
                [
                    'name'=>__("Edit User: #:id",['id'=>$row->id]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('User::admin.detail', $data);
    }

    public function password(Request $request,$id){

        $row = User::find($id);
        $data  = [
            'row'=>$row,
            'currentUser'=>Auth::user()
        ];
        if (empty($row)) {
            return redirect('admin/module/user');
        }
        if ($row->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
            abort(403);
        }
        return view('User::admin.password',$data);
    }

    public function changepass(Request $request, $id)
    {
        if(is_demo_mode()){
            return redirect()->back()->with("error", __("DEMO MODE: You can not change password!"));
        }
        $rules = [];
        $urow = User::find($id);
        if ($urow->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
            abort(403);
        }
        $request->validate([
            'password'              => 'required|min:6|max:255|confirmed',
        ]);
        $password = $request->input('password');

        if ($urow->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
            if ($password) {
                if ($urow->id != Auth::user()->id) {
                    $rules['old_password'] = 'required';
                }
            }
            $this->validate($request, $rules);
            if ($password) {
                if (!(Hash::check($request->input('old_password'), $urow->password))) {
                    // The Old passwords matches
                    return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
                }
            }
        }
        $this->setUserPassword($urow,$password);
        $urow->setRememberToken(Str::random(60));

        if ($urow->save()) {
            return redirect()->back()->with('success', __('Password updated!'));
        }
    }

    public function store(Request $request, $id)
    {

        if(is_demo_mode()){
            return back()->with('danger',  __('DEMO Mode: You can not do this') );
        }

        $user_type = $request->input('user_type');

        if($id and $id>0){
            $row = User::find($id);
            if(empty($row)){
                abort(404);
            }
            if ($row->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
                abort(403);
            }
        }else{
            $this->checkPermission('user_manage');
            $row = new User();
        }
        $rules = [
            'first_name'              => 'required|max:255',
            'last_name'              => 'required|max:255',
            'business_name'              => 'required|max:255',
            'status'              => 'required|max:50',
            'role_id'              => 'required|max:11',
            'email'              =>[
                'required',
                'email',
                'max:255',
                $id > 0 ? Rule::unique('users')->ignore($row->id) : Rule::unique('users')
            ],
        ];
        switch ($user_type){
            case "vendor":
                unset($rules['role_id']);
                break;
        }

        $request->validate($rules,[
            'business_name.required'=>__("Display name is a required field")
        ]);

        $data = [
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'phone'=>$request->input('phone'),
            'birthday'=>$request->input('birthday') ? date("Y-m-d", strtotime($request->input('birthday'))) : null,
            'bio'=>$request->input('bio'),
            'status'=>$request->input('status'),
            'avatar_id'=>$request->input('avatar_id'),
            'email'=>$request->input('email'),
            'business_name'=>$request->input('business_name'),
        ];

        switch ($user_type){
            case "vendor":
            default:
                $data['commission_type'] = $request->input('commission_type');
                $data['commission'] = $request->input('commission');
                break;
        }

        if($this->hasPermission('user_manage')) {
            switch ($user_type){
                case "vendor":
                    if(!$row->id) {
                        $row->role_id = setting_item('vendor_role');
                    }
                    break;
                case "customer":
                    if(!$row->id) {
                        $row->role_id = setting_item('customer_role');
                    }
                    break;
                default:
                    $row->role_id = $request->input('role_id');
                    break;
            }
            if($request->input('is_email_verified')){
                if(!$row->email_verified_at) $row->email_verified_at = date('Y-m-d H:i:s');
            }else{
                $row->email_verified_at = null;
            }
        }

        $row->fillByAttr(array_keys($data),$data);

        if ($row->save()) {

            $metaKeys = [

            ];

            switch ($user_type){
                case "vendor":
                    $metaKeys[] = 'vendor_mode';
                    break;
            }

            foreach ($metaKeys as $key){
                $row->addMeta($key,$request->input($key));
            }

            if($id > 0){
                return back()->with('success', __('User updated'));
            }else{
                switch ($request->input('user_type')){
                    case"customer":
                        return redirect()->route('customer.admin.edit',['id'=>$row->id])->with('success',__("Customer created"));
                        break;
                    case"vendor":
                        return redirect()->route('vendor.admin.edit',['id'=>$row->id])->with('success',__("Vendor created"));
                        break;
                    default:
                        return redirect()->route('user.admin.edit',['id'=>$row->id])->with('success',__("User created"));
                }
            }
        }
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = User::select('*');
        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('first_name', 'like', '%' . $q . '%')->orWhere('last_name', 'like', '%' . $q . '%')->orWhere('email', 'like', '%' . $q . '%')->orWhere('id', $q)->orWhere('phone', 'like', '%' . $q . '%');
            });
        }
        if($request->query("user_type") == "vendor"){
            $query->where('role_id',3);
        }
        $res = $query->orderBy('id', 'desc')->orderBy('first_name', 'asc')->limit(20)->get();

        return [
            'results'=>UserResource::collection($res,['address'])
        ];
    }

    public function bulkEdit(Request $request)
    {
        if(is_demo_mode()){
            return redirect()->back()->with("error","DEMO MODE: You are not allowed to do it");
        }
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids))
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        if (empty($action))
            return redirect()->back()->with('error', __('Select an Action!'));
        if ($action == 'delete') {
            foreach ($ids as $id) {
                if($id == Auth::id()) continue;
                $query = User::where("id", $id)->first();
                if(!empty($query)){
                    $query->email.='_d_'.uniqid().rand(0,99999);
                    $query->save();
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                User::where("id", $id)->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated successfully!'));
    }

    public function export(Request $request)
    {
        $role_id = $request->input('role_id','');
        return (new UserExport($role_id))->download('user-' . date('M-d-Y') . '.xlsx');
    }
    public function verifyEmail(Request $request,$id)
    {
        $user = User::find($id);
        if(!empty($user)){
            $user->email_verified_at = now();
            $user->save();
            return redirect()->back()->with('success', __('Verify email successfully!'));
        }else{
            return redirect()->back()->with('error', __('Verify email cancel!'));
        }
    }

}
