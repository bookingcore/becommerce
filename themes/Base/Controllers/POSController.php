<?php


namespace Themes\Base\Controllers;


class POSController extends FrontendController
{

    public function index(){
        if($this->hasPermission('pos_access')){
            return redirect('/');
        }
        return view('pos.index');
    }
}
