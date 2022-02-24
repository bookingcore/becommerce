<?php


namespace Themes\Base\Controllers\Vendor;


use App\User;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttr;
use Modules\Product\Models\ProductBrand;
use Modules\Review\Models\Review;
use Modules\Vendor\VendorMenuManager;
use Themes\Base\Controllers\FrontendController;

class StoreController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        VendorMenuManager::setActive('profile');
    }

    public function index(Request $request,$slug){
        $user = User::where('username', '=', $slug)->first();

        if(empty($user)){
            abort(404);
        }


        $param = $request->input();
        $param['limit'] = 6;
        $param['vendor_id'] = $user->id;
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

        return view('store.index',$data);
    }

    public function alLReviews(Request $request,$slug){
        $user = User::where('username', '=', $slug)->first();
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

        return view('store.index',$data);
    }

    public function profile()
    {
        $data = [
            'row'=> auth()->user(),
            'page_title'=>__("Store settings"),
        ];

        return view('vendor.store.profile',$data);
    }

    public function profileStore(Request $request)
    {
        $request->validate([
            'business_name'=>'required|max:255'
        ]);
        $vendor = auth()->user();
        $vendor->business_name = $request->input('business_name');
        $vendor->avatar_id = $request->input('avatar_id');
        if ($vendor->save()) {
            return redirect()->route('vendor.profile')->with('success',__("Store updated"));
        }
    }
}
