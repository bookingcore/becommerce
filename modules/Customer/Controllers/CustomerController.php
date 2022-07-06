<?php
namespace Modules\Customer\Controllers;

use Illuminate\Http\Request;
use Modules\Customer\Resources\CustomerResource;
use Modules\FrontendController;
use Modules\User\Models\User;

class CustomerController extends FrontendController
{

    public function getForSelect2(Request $request){
        $q = User::query();

        if($s = $request->query('s'))
        {
            $q->where(function($query) use ($s){
               $query->where('first_name','like','%'.$s.'%');
               $query->orWhere('email','like','%'.$s.'%');
               $query->orWhere('id',$s);
               $query->orWhere('phone',$s);
            });
        }

        $q->orderByDesc('id');
        return CustomerResource::collection($q->paginate(20));
    }
}
