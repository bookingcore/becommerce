<?php


namespace Themes\Base\Controllers;


class HomeController extends FrontendController
{
    public function index(){
        $data = [
            'page_title'=>__("Home")
        ];
        return view('index',$data);
    }
}
