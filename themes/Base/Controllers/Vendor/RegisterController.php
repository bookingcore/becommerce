<?php


namespace Themes\Base\Controllers\Vendor;


use App\Helpers\ReCaptchaEngine;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\User\Events\SendMailUserRegistered;
use Modules\Vendor\Events\UpgradeRequestCreated;
use Modules\Vendor\Events\VendorRegisteredEvent;
use Modules\Vendor\Models\VendorRequest;
use Themes\Base\Controllers\FrontendController;

class RegisterController extends FrontendController
{

    public function index(){

        $this->validateRequest();

        $data = [
            'page_title'=>__("Sell on Us")
        ];
        return view('vendor.register',$data);
    }

    public function store(Request $request){
        $this->validateRequest();

        $messages = [
            'email.required'      => __('Email is required field'),
            'email.email'         => __('Email invalidate'),
            'password.required'   => __('Password is required field'),
            'password.match'   => __('Password does not match'),
            'first_name.required' => __('The first name is required field'),
            'last_name.required'  => __('The last name is required field'),
            'business_name.required'  => __('The business name is required field'),
            'term.required'       => __('Please read and accept terms and conditions'),
        ];
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'business_name'=>'required',
            'email'=>[
                'required','email',Rule::unique('users')
            ],
            'password'=>'required|confirmed|min:8',
            'term'=>'required'
        ],$messages);

        if (ReCaptchaEngine::isEnable() and setting_item("vendor_enable_register_recaptcha")) {
            $codeCapcha = $request->input('g-recaptcha-response');
            if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                return back()->with('danger',__('Please verify the captcha'));
            }
        }

        $data = [
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'email'      => $request->input('email'),
            'business_name'      => $request->input('business_name'),
            'password'   => Hash::make($request->input('password')),
            'status'     => 'publish'
        ];

        if(\auth()->check()){
            $user = \auth()->user();
            unset($data['password']);
            unset($data['status']);
            unset($data['email']);
        }else {
            $user = new User($data);
        }
        $user->fillByAttr(array_keys($data),$data);
        $user->save();

        $vendorAutoApproved = setting_item('vendor_auto_approved');
        if($vendorAutoApproved==1){
            $dataVendor['status']='approved';
            $dataVendor['approved_time']=now();
        }else{
            $dataVendor['status']='pending';
        }
        $dataVendor['role_request']= setting_item('vendor_role',3);
        $user->assignRole((int)$dataVendor['role_request']);

        $user->vendorRequest()->save( new VendorRequest($dataVendor));

        if(!\auth()->check()) {
            Auth::login($user);
            event(new VendorRegisteredEvent($user, $user->vendorRequest));
        }else{
            event(new UpgradeRequestCreated($user, $user->vendorRequest));
        }

        if(is_vendor()){
            return redirect(route('vendor.dashboard'))->with("success",__("Thank you for register. Now you can start selling with us!"));
        }else{
            return redirect(route('user.profile'))->with("success",__("Register success. Please wait for approval"));
        }

    }

    protected function validateRequest(){
        if(!is_vendor_enable()){
            return redirect('/');
        }
        if(\auth()->check()){
            if(is_vendor()){
                return redirect(route('vendor.dashboard'));
            }
            $user = \auth()->user();
            if($user->vendorRequest){
                return redirect(route('user.profile'))->with("success",__("Please wait for approval"));
            }
        }

    }

}
