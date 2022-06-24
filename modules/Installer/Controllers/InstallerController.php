<?php


namespace Modules\Installer\Controllers;


use App\Http\Controllers\Controller;

class InstallerController extends Controller
{

    public function index(){
        return view("Installer::frontend.index");
    }

    /**
     * Get a folder permission.
     *
     * @param $folder
     * @return string
     */
    private function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }

    public function checkPermissions(){
        $folders = config('installer.permissions');
        foreach ($folders as $folder => $permission) {
            if (! ($this->getPermission($folder) >= $permission)) {
                $results[] = [$folder,$permission,false];
            } else {
                $results[] = [$folder,$permission,true];
            }
        }

        return $results;
    }
}
