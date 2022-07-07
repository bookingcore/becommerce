<?php

namespace Modules\POS\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Customer\Resources\CustomerResource;
use Modules\FrontendController;
use Modules\Order\Models\Order;
use Modules\Order\Resources\Admin\OrderResource;
use Modules\Order\Rules\ValidOrderItems;
use Modules\Product\Models\UserAddress;

class CustomerController extends FrontendController
{
    public function store(Request $request){
        if(!$this->hasPermission('pos_access')){
            return $this->sendError(__("You are not allowed to access this function"));
        }
        $rules = [
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required|unique:users,phone',
            'email'=>'required|email|unique:users,email',
        ];

        $request->validate($rules);


        $data = [
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'status'=>'publish'
        ];
        $user = new User();
        $user->fillByAttr(array_keys($data),$data);
        $user->save();
        $user->assignRole('customer');

        $data = [
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'address'=>$request->input('address')
        ];
        $address = new UserAddress();
        $address->fillByAttr(array_keys($data),$data);
        $address->address_type = $address::BILLING;
        $address->user_id = $user->id;
        $address->is_default = 1;
        $address->save();

        return $this->sendSuccess(['data'=>new CustomerResource($user)],__("Customer created"));
    }
}
