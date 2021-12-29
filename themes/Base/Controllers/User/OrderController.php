<?php


namespace Themes\Base\Controllers\User;


use Modules\Order\Models\Order;
use Themes\Base\Controllers\FrontendController;

class OrderController extends FrontendController
{

    public function index(){
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
    public function detail($id){
        $order = Order::query()->where([
            'customer_id'=>auth()->id(),
            'id'=>$id
        ])->first();
        if(!$order){
            abort(404);
        }

        $data = [
            'page_title'=>__("My Orders"),
            'order'=>$order,
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'name'=>__("My Account")
                ],
                [
                    'url'=>route('user.order.index'),
                    'name'=>__("Orders")
                ],
                [
                    'name'=>__("Order: #").$order->id
                ],
            ],
            'user'=>auth()->user()
        ];
        return view('user.order-detail',$data);
    }
}
