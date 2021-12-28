<?php


namespace Themes\Base\Controllers\User;


use Themes\Base\Controllers\FrontendController;

class AddressController extends FrontendController
{

    public function index(){
        $user = auth()->user();
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
            "billing"=>$user->billing_address,
            "shipping"=>$user->shipping_address,
        ];
        return view('user.address',$data);
    }
    public function detail($type){
        if(!in_array($type,['billing','shipping'])){
            return redirect(route('user.address.index'));
        }
        $user = auth()->user();
        $page_title = $type == 'billing' ? __('Billing address') : __('Shipping address');
        $data = [
            'user'=>auth()->user(),
            'page_title'=>$page_title,
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'name'=>__("My Account")
                ],
                [
                    'url'=>route('user.address.index'),
                    'name'=>__("Address")
                ],
                [
                    'name'=>$page_title
                ],
            ],
            "address"=>$type == 'billing' ? $user->billing_address : $user->shipping_address,
            'type'=>$type
        ];
        return view('user.address-edit',$data);
    }
}
