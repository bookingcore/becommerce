<?php

namespace Themes\Zeomart\Controllers\Vendor;

use App\User;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttr;
use Modules\Product\Models\ProductBrand;
use Themes\Base\Controllers\FrontendController;
use Themes\Zeomart\Models\Vendor;

class StoreController extends FrontendController
{

    public function index(Request $request,$slug){
        $user = Vendor::where('username', '=', $slug)->first();

        if(empty($user)){
            abort(404);
        }


        $param = $request->input();
        $param['limit'] = 6;
//        $param['vendor_id'] = $user->id;
        $topSell = Product::search($param)->orderBy('sale_count','desc')->limit(12)->get();
        $data = [
            'rows'               => Product::search($param)->paginate(10),
            'topSell'               => $topSell,
            'user'               => $user,
            'product_min_max_price' => Product::getMinMaxPrice(),
            'breadcrumbs'=>[
                [
                    'name'=> $user->display_name,
                ]
            ],
            "page_title"           => $user->display_name,
        ];
        $data['attributes'] = ProductAttr::search()->with('terms.translation')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();

        return view('store.index',$data);
    }


}

