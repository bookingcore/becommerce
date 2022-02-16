<?php


namespace Modules\Vendor\Admin;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\User\Events\VendorApproved;
use Modules\User\Models\Role;
use Modules\Vendor\Models\VendorRequest;

class RegisterRequestController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('vendor');
    }
    public function index(Request $request)
    {
        $this->checkPermission('vendor_register_approve');
        $listUser = VendorRequest::query();
        $data = [
            'rows' => $listUser->with(['user','role','approvedBy'])->orderBy('id','desc')->paginate(20),
            'roles' => Role::all()
        ];
        return view('Vendor::admin.register-request', $data);
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('vendor_register_approve');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids))
            return redirect()->back()->with('error', __('Select at leas 1 item!'));
        if (empty($action))
            return redirect()->back()->with('error', __('Select an Action!'));

        switch ($action){
            case "delete":
                foreach ($ids as $id) {
                    $query = VendorRequest::find( $id);
                    if(!empty($query)){
                        $query->delete();
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            default:
                foreach ($ids as $id) {
                    $vendorRequest = VendorRequest::find( $id);
                    if(!empty($vendorRequest)){
                        $vendorRequest->update(['status' => $action,'approved_time'=>now(),'approved_by'=>Auth::id()]);
                        $user = User::find($vendorRequest->user_id);
                        if(!empty($user)){
                            $user->syncRoles($vendorRequest->role_request);
                        }
                        event(new VendorApproved($user,$vendorRequest));
                    }
                }
                return redirect()->back()->with('success', __('Updated successfully!'));
                break;
        }
    }

    public function store(Request $request, $id)
    {
        $this->checkPermission('vendor_register_approve');
        if (empty($id))
            return redirect()->back()->with('error', __('Select at least 1 item!'));

        $vendorRequest = VendorRequest::find( $id);
        if(!empty($vendorRequest)){
            $vendorRequest->update(['status' => 'approved','approved_time'=>now(),'approved_by'=>Auth::id()]);
            $user = User::find($vendorRequest->user_id);
            if(!empty($user)){
                $user->syncRoles($vendorRequest->role_request);
            }

            event(new VendorApproved($user,$vendorRequest));
        }
        return redirect()->back()->with('success', __('Updated successfully!'));
    }


}
