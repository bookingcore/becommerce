<?php


    namespace Modules\Vendor\Controllers;


    use App\Helpers\ReCaptchaEngine;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\MessageBag;
    use Matrix\Exception;
    use Modules\User\Events\SendMailUserRegistered;
    use Modules\Vendor\Models\VendorRequest;

    class VendorController
    {

        public function register(Request $request)
        {
            $rules = [
                'first_name' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'last_name'  => [
                    'required',
                    'string',
                    'max:255'
                ],
                'email'      => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users'
                ],
                'password'   => [
                    'required',
                    'string'
                ],
                'term'       => ['required'],
            ];
            $messages = [
                'email.required'      => __('Email is required field'),
                'email.email'         => __('Email invalidate'),
                'password.required'   => __('Password is required field'),
                'first_name.required' => __('The first name is required field'),
                'last_name.required'  => __('The last name is required field'),
                'term.required'       => __('The terms and conditions field is required'),
            ];

            if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
                $codeCapcha = $request->input('g-recaptcha-response');
                if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                    $errors = new MessageBag(['message_error' => __('Please verify the captcha')]);
                    return response()->json(['error'    => true,
                                             'messages' => $errors
                    ], 200);
                }
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['error'    => true,
                                         'messages' => $validator->errors()
                ], 200);
            } else {
                $user = \App\User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name'  => $request->input('last_name'),
                    'email'      => $request->input('email'),
                    'password'   => Hash::make($request->input('password')),
                    'status'     => 'publish'
                ]);


//                check vendor auto approved
                $vendorAutoApproved = setting_item('vendor_auto_approved');
                if($vendorAutoApproved==1){
                    $dataVendor['status']='approved';
                    $dataVendor['approved_time']=now();
                }else{
                    $dataVendor['status']='pending';
                }
                $dataVendor['role_request']= setting_item('vendor_role','1');
                $vendorRequestData = $user->vendorRequest()->save( new VendorRequest($dataVendor));

                Auth::loginUsingId($user->id);
                try {
                    event(new SendMailUserRegistered($user));
                } catch (Exception $exception) {
                    Log::warning("SendMailUserRegistered: " . $exception->getMessage());
                }
                $user->assignRole($dataVendor['role_request']);
                return response()->json([
                    'error'    => false,
                    'messages' => false,
                    'redirect' => $request->headers->get('referer') ?? url(app_get_locale(false, '/'))
                ], 200);
            }
        }
    }
