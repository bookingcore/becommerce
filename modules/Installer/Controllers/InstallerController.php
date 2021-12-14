<?php


namespace Modules\Installer\Controllers;


use App\Http\Controllers\Controller;

class InstallerController extends Controller
{

    public function index(){
        return view("Installer::frontend.index");
    }
}
