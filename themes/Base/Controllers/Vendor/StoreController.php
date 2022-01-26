<?php


namespace Themes\Base\Controllers\Vendor;


use Illuminate\Http\Request;
use Themes\Base\Controllers\FrontendController;

class StoreController extends FrontendController
{

    public function index(Request $request, $slug){

    }

    public function profile()
    {
        $data = [
            'row'=> auth()->user(),
            'page_title'=>__("Vendor profile"),
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
            return redirect()->route('vendor.profile')->with('success',__("Vendor updated"));
        }
    }
}
