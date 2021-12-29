<?php

namespace Themes\Base\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Themes\Base\Controllers\FrontendController;

class NotificationController extends FrontendController
{

    public function index(Request $request){
        $type = $request->get('type', '');
        $query  = \Modules\Core\Models\NotificationPush::query();

        if(is_admin()){
            $query->where(function($q){
                $q->where('data', 'LIKE', '%"for_admin":1%');
                $q->orWhere('notifiable_id', Auth::id());
            });
        }else{
            $query->where('data', 'LIKE', '%"for_admin":0%');
            $query->where('notifiable_id', Auth::id());
        }

        if($type == 'unread'){
            $query->where('read_at', null);
        }

        if($type == 'read'){
            $query->where('read_at', '!=', null);
        }

        $query->orderBy('id','desc');

        $data = [
            'rows'                  => $query->paginate(20),
            'page_title'=>__('Notifications'),
            'user'=>auth()->user(),
            'type'=>$type
        ];
        return view('user.notification',$data);
    }
}
