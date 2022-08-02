<?php
namespace Themes\demus\Controllers\Vendor;
use App\Helpers\ReCaptchaEngine;
use App\User;
use Carbon\Carbon;
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
use Themes\demus\Controllers\FrontendController;

class RegisterController extends FrontendController
{

    public function index(){

        $check = $this->validateRequest();
        if($check !== true) return $check;

        $data = [
            'page_title'=>__("Sell on Us")
        ];
        return view('vendor.register',$data);
    }

    public function store(Request $request){

        if(is_demo_mode()){
            return back()->with('danger',  __('DEMO Mode: You can not do this') );
        }

        $check = $this->validateRequest();
        if($check !== true) return $check;

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
        $validates = [
            'first_name'=>'required',
            'last_name'=>'required',
            'business_name'=>'required',
            'email'=>[
                'required','email',Rule::unique('users')
            ],
            'password'=>'required|confirmed|min:6',
            'term'=>'required'
        ];
        if(\auth()->user()){
            unset($validates['email']);
            unset($validates['password']);
        }
        $request->validate($validates,$messages);

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

        if(\auth()->user()){
            $user = \auth()->user();
            unset($data['password']);
            unset($data['status']);
            unset($data['email']);
        }else {
            $user = new User($data);
        }
        $user->fillByAttr(array_keys($data),$data);
        if(!setting_item('enable_email_verification')){
            $user->email_verified_at = Carbon::now();
        }
        $user->save();

        $dataVendor['role_request']= setting_item('vendor_role',3);
        $vendorAutoApproved = setting_item('vendor_auto_approved');
        if($vendorAutoApproved==1){
            $dataVendor['status']='approved';
            $dataVendor['approved_time']=now();
            $user->assignRole((int)$dataVendor['role_request']);
        }else{
            $dataVendor['status']='pending';
            $user->assignRole(2);
        }

        $dataVendor['user_id'] = $user->id;
        $vendor_request = VendorRequest::create($dataVendor);

        if(!\auth()->check()) {
            Auth::login($user);
            event(new VendorRegisteredEvent($user, $vendor_request));
        }else{
            event(new UpgradeRequestCreated($user, $vendor_request));
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

        return true;
    }

}
