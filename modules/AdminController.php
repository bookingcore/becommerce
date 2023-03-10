<?php
namespace Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Helpers\AdminMenuManager;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkPermission($permission = false)
    {
        if ($permission) {
            if (!Auth::user()->hasPermission($permission)) {
                abort(403);
            }
        }
    }

    public function hasPermission($permission)
    {
        return Auth::user()->hasPermission($permission);
    }

    public function setActiveMenu($item)
    {
        AdminMenuManager::setActive($item);
    }
}
