<?php


namespace Themes\Base\Controllers;


class HomeController extends FrontendController
{
    public function index(){
        return view('index');
    }
}
