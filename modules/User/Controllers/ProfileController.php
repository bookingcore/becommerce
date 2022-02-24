<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 8/17/2019
 * Time: 3:05 PM
 */
namespace Modules\User\Controllers;

use App\User;
use Illuminate\Http\Request;
use Modules\FrontendController;
use Modules\Gig\Models\Gig;

class ProfileController extends FrontendController
{
    public function profile(Request $request,$id_or_slug){

        $user = User::where('email', '=', $id_or_slug)->first();
        if(empty($user)){
            $user = User::find($id_or_slug);
        }
        if(empty($user)){
            abort(404);
        }
        if(!$user->hasPermission('dashboard_vendor_access'))
        {
            return redirect('/');
        }
        $data['user'] = $user;
        $data['page_title'] = $user->display_name;
        $this->registerCss('dist/frontend/module/user/css/profile.css');
        return view('User::frontend.profile.profile',$data);
    }

    public function alLReviews(Request $request,$id_or_slug){
        $user = User::where('email', '=', $id_or_slug)->first();
        if(empty($user)){
            $user = User::find($id_or_slug);
        }
        if(empty($user)){
            abort(404);
        }
        $data['user'] = $user;
        $data['page_title'] = __(':name - reviews from guests',['name'=>$user->display_name]);
        $data['breadcrumbs'] = [
            ['name'=>$user->display_name,'url'=>route('user.profile',['id'=>$user->user_name ?? $user->id])],
            ['name'=>__('Reviews from guests'),'url'=>''],
        ];
        $this->registerCss('dist/frontend/module/user/css/profile.css');
        return view('User::frontend.profile.all-reviews',$data);
    }
    public function allServices(Request $request,$id_or_slug){
        $user = User::where('email', '=', $id_or_slug)->first();
        if(empty($user)){
            $user = User::find($id_or_slug);
        }
        if(empty($user)){
            abort(404);
        }
        $data['user'] = $user;
        $data['page_title'] = __(':name',['name'=>$user->display_name]);
        $data['breadcrumbs'] = [
            ['name'=>$user->display_name,'url'=>route('user.profile',['id'=>$user->user_name ?? $user->id])],
            ['name'=>__(':type by :first_name',['type'=>"Gig",'first_name'=>$user->first_name]),'url'=>''],
        ];
        $data['type'] = 'gig';
        $data['services'] = Gig::getVendorServicesQuery($user->id)->orderBy('id','desc')->paginate(6);
        $this->registerCss('dist/frontend/module/user/css/profile.css');
        return view('User::frontend.profile.all-services',$data);
    }
}
