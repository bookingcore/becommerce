<?php


namespace Themes\Base\Controllers\User;


use Themes\Base\Controllers\FrontendController;

class AddressController extends FrontendController
{

    public function index(){
        $data = [
            'user'=>auth()->user(),
            'page_title'=>__("Address"),
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'name'=>__("My Account")
                ],
                [
                    'name'=>__("Address")
                ],
            ],
        ];
        return view('user.address',$data);
    }
}
