<?php


namespace Themes\Base\Controllers;


class POSController extends FrontendController
{

    public function index(){
//        if($this->hasPermission('pos_access')){
//            return redirect('/');
//        }
        $data = [
            'page_title'=>__("Point of Sale")
        ];
        return view('pos.index',$data);
    }
}
