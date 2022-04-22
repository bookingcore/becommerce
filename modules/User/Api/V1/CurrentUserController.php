<?php


namespace Modules\User\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\User\Models\UserWishList;
use Modules\User\Resources\UserResource;
use Modules\User\Resources\UserWishlistResource;

class CurrentUserController extends ApiController
{

    protected $userWishListClass;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserWishList $user_wish_list)
    {
        $this->middleware('auth:sanctum', ['except' => []]);
        $this->userWishListClass = $user_wish_list;
    }

    public function me()
    {
        return new UserResource(auth()->user());
    }

    public function address()
    {
        return new UserResource(auth()->user(),[
            'address'
        ]);
    }

    public function wishlist(){
        $wishlist = $this->userWishListClass::query()
            ->where("user_wishlist.user_id",Auth::id())
            ->orderBy('user_wishlist.id', 'desc');
        return UserWishlistResource::collection($wishlist->with(['service'])->paginate(20));
    }

    public function wishlistStore(Request $request){

        $rules = [
            'object_id'   => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError('',['errors'=>$validator->errors()]);
        }

        $object_id = $request->input('object_id');
        if(empty($object_id))
        {
            return $this->sendError(__("Object ID is required"));
        }
        $object_model = 'product';

        $meta = $this->userWishListClass::where("object_id",$object_id)
            ->where("object_model",$object_model)
            ->where("user_id",Auth::id())
            ->first();
        if(!empty($meta)){
            return $this->sendError(__("Item already exists in your wishlist"),['code'=>'wishlist_exists']);
        }

        $meta = new $this->userWishListClass($request->input());
        $meta->user_id = Auth::id();
        $meta->object_model = $object_model;
        $meta->save();

        return $this->sendSuccess(__("Added to your Wishlist"));
    }
    public function wishlistDelete(Request $request){

        $rules = [
            'object_id'   => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError('',['errors'=>$validator->errors()]);
        }

        $object_id = $request->input('object_id');
        if(empty($object_id))
        {
            return $this->sendError(__("Object ID is required"));
        }

        $this->userWishListClass::where("object_id",$object_id)
            ->where("user_id",Auth::id())
            ->delete();

        return $this->sendSuccess(__("Removed from your Wishlist"));
    }
}
