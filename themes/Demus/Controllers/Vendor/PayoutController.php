<?php


namespace Themes\demus\Controllers\Vendor;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\Models\VendorPayout;
use Modules\Vendor\Models\VendorPayoutAccount;
use Modules\Vendor\VendorMenuManager;
use Themes\demus\Controllers\FrontendController;

class PayoutController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        VendorMenuManager::setActive('payout');
    }

    public function index(){

        $user = Auth::user();
        $data = [
            'page_title'=>__('Payouts'),
            'payouts'=>$user->payouts()->orderBy('id','desc')->paginate(20),
            'currentUser'=>Auth::user(),
            "current_payout"=>$user->current_payout,
            'payout_account'=>$user->payout_account
        ];

        return view("vendor.payout.index",$data);
    }

    public function storePayoutAccount(Request $request){

        $this->checkPermission('product_create');

        $request->validate([
            'payout_method'=>"required",
            "account_info"=>'required|array'
        ]);

        $user = Auth::user();
        $payout_account = $user->payout_account;
        if(!$payout_account){
            $payout_account = new VendorPayoutAccount();
            $payout_account->vendor_id = $user->id;
        }

        $account_info = $request->input('account_info');
        $payout_method = $request->input('payout_method');
        if(empty($account_info[$payout_method])){
            return $this->sendError(__("Please enter payout account info"));
        }

        $data = [
            'payout_method'=>$request->input('payout_method'),
            'account_info'=>[$account_info[$payout_method]]
        ];
        $payout_account->fillByAttr(array_keys($data),$data);

        $payout_account->save();

        return $this->sendSuccess([
            "message"=>__("Your account information has been saved")
        ]);

    }
}
