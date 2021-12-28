<?php

namespace Themes\Base\Controllers;

use Modules\Order\Models\Order;

class UserController extends FrontendController
{

    public function order(){
        $query = Order::query()->where('customer_id',auth()->id())->orderByDesc('id');

        $data = [
            'page_title'=>__("My Orders"),
            'rows'=>$query->paginate(20),
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'name'=>__("My Account")
                ],
                [
                    'name'=>__("Orders")
                ],
            ],
            'user'=>auth()->user()
        ];
        return view('user.order',$data);
    }
}
