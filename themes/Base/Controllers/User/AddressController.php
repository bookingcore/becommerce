<?php


namespace Themes\Base\Controllers\User;


use Illuminate\Http\Request;
use Modules\Product\Models\UserAddress;
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

    public function store(Request $request,$type){
        if(!in_array($type,['billing','shipping'])){
            return redirect(route('user.address.index'));
        }
        $user = auth()->user();

        $address = $type == 'billing' ? $user->billing_address : $user->shipping_address;

        $rules = [
            'first_name'=>'required|max:190',
            'last_name'=>'required|max:190',
            'country'=>'required|max:30',
            'address'=>'required|max:190',
            'city'=>'required|max:190',
            'phone'=>'required|max:190',
            'email'=>'required|email',
        ];
        if($type == 'shipping'){
            unset($rules['phone']);
            unset($rules['email']);
        }
        $request->validate($rules);

        if(!$address){
            $address = new UserAddress();
            $address->address_type = $type == 'billing' ? 1 : 2;
            $address->user_id = $user->id;
            $address->is_default = 1;
        }
        $keys = [
            'first_name',
            'last_name',
            'company',
            'country',
            'address',
            'address2',
            'postcode',
            'city',
            'state',
            'phone',
            'email',
        ];
        $address->fillByAttr($keys,$request->input());
        $address->save();

        return redirect()->back()->with('success',$type == 'billing' ? __("Billing address updated") : __("Shipping address updated"));
    }
}
