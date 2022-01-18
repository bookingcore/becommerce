<?php
namespace Themes\Base\Controllers;

use App\User;
use Illuminate\Http\Request;
use Modules\FrontendController;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttr;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Review\Models\Review;

class ProfileController extends FrontendController
{
    public function profile(Request $request,$id_or_slug){
        $user = User::where('username', '=', $id_or_slug)->first();
        if(empty($user)){
            $user = User::find($id_or_slug);
        }
        if(empty($user)){
            abort(404);
        }
        /*if(!$user->hasPermissionTo('dashboard_vendor_access'))
        {
            return redirect('/');
        }*/

        $param = $request->input();
        $param['limit'] = 6;
        $data = [
            'rows'               => Product::search($param),
            'user'               => $user,
            'product_min_max_price' => Product::getMinMaxPrice(),
            'breadcrumbs'=>[
                [
                    'name'=> $user->getDisplayName(),
                ]
            ],
            "page_title"           => $user->getDisplayName(),
        ];
        $data['attributes'] = ProductAttr::search()->with('terms.translation')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();

        return view('user.profile.index',$data);
    }

    public function alLReviews(Request $request,$id_or_slug){
        $user = User::where('username', '=', $id_or_slug)->first();
        if(empty($user)){
            $user = User::find($id_or_slug);
        }
        if(empty($user)){
            abort(404);
        }
        $reviews = Review::query()->where([
            'vendor_id'=>$user->id,
            'status'=>'approved'
        ])
            ->orderBy('id','desc')
            ->with('author')
            ->paginate(10);
        $data = [
            'rows'               => $reviews,
            'user'               => $user,
            'product_min_max_price' => Product::getMinMaxPrice(),
            'breadcrumbs'=>[
                ['name'=>$user->getDisplayName(),'url'=>route('user.profile',['id'=>$user->user_name ?? $user->id])],
                ['name'=>__('Reviews from guests'),'url'=>''],
            ],
            "page_title"           => __(':name - reviews from guests',['name'=>$user->getDisplayName()]),
            "show_review"           =>1,
        ];
        $data['attributes'] = ProductAttr::search()->with('terms.translation')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();

        return view('user.profile.index',$data);
    }
    public function allServices(Request $request,$id_or_slug){
        $all = get_bookable_services();
        $type = $request->query('type');
        if(empty($type) or !array_key_exists($type,$all))
        {
            abort(404);
        }
        $moduleClass = $all[$type];
        $user = User::where('user_name', '=', $id_or_slug)->first();
        if(empty($user)){
            $user = User::find($id_or_slug);
        }
        if(empty($user)){
            abort(404);
        }
        $data['user'] = $user;
        $data['page_title'] = __(':name - :type',['name'=>$user->getDisplayName(),'type'=>$moduleClass::getModelName()]);
        $data['breadcrumbs'] = [
            ['name'=>$user->getDisplayName(),'url'=>route('user.profile',['id'=>$user->user_name ?? $user->id])],
            ['name'=>__(':type by :first_name',['type'=>$moduleClass::getModelName(),'first_name'=>$user->first_name]),'url'=>''],
        ];
        $data['type'] = $type;
        $data['services'] = $all[$type]::getVendorServicesQuery($user->id)->orderBy('id','desc')->paginate(6);
        //$this->registerCss('dist/frontend/module/user/css/profile.css');
        return view('User::frontend.profile.all-services',$data);
    }
}