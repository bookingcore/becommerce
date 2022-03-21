<?php
namespace Modules\Customer\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\User\Admin\UserController;
use Modules\User\Models\Role;


class CustomerController extends UserController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('customer');
    }

    public function index(Request $request)
    {
        $this->checkPermission('customer_view');
        $username = $request->query('s');
        $listUser = User::query()->where('role_id',2)->orderBy('id','desc');
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
        return view('Customer::admin.index', $data);
    }

    public function create(Request $request)
    {

        $row = new \Modules\User\Models\User();
        $data = [
            'row' => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
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
            return redirect(route('customer.admin.index'));
        }
        if ($row->id != Auth::user()->id and !Auth::user()->hasPermission('user_manage')) {
            abort(403);
        }
        $data = [
            'row'   => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Edit User: #:id",['id'=>$row->id]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('User::admin.detail', $data);
    }
}
