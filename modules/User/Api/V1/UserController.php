<?php


namespace Modules\User\Api\V1;


use App\User;
use Illuminate\Http\Request;
use Modules\FrontendController;
use Modules\User\Resources\UserResource;

class UserController extends FrontendController
{

    public function index(){
        $this->checkPermission("user_manage");

        $query = User::query();
        return UserResource::collection($query->paginate(20));
    }

    public function patch(Request $request,$id){
        $this->checkPermission("user_manage");

        $user = User::find($id);
        if(!$user){
            abort(404);
        }

        $data = $request->input('data');
        $white_list = [

        ];

        foreach ($data as $k=>$v){
            if(!in_array($k,$white_list)) continue;
            $user->setAttribute($k,$v);
        }
        $user->save();

        return [
            "data"=>new UserResource($user)
        ];
    }
}
