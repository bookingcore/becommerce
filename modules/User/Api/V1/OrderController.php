<?php


namespace Modules\User\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Order\Models\Order;
use Modules\User\Models\UserWishList;
use Modules\User\Resources\UserOrderResource;

class OrderController extends ApiController
{
    protected $order;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->middleware('auth:sanctum', ['except' => []]);
        $this->order = $order;
    }

    public function index(){
        $query = Order::query()->where('customer_id',auth()->id())->orderByDesc('id');

        return UserOrderResource::collection($query->paginate(20));
    }

    public function detail($id){

        $order = Order::query()->where('customer_id',auth()->id())->whereId($id)->first();

        if(!$order){
            abort(404);
        }

        return new UserOrderResource($order,[
            'items'
        ]);
    }
}
