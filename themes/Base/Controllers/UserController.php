<?php

namespace Themes\Base\Controllers;

use App\Helpers\ReCaptchaEngine;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Modules\User\Events\SendMailUserRegistered;
use Validator;

class UserController extends FrontendController
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
                'string',
                'min:6'
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
        if (ReCaptchaEngine::isEnable() and setting_item("user_enable_login_recaptcha")) {
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
            return $this->sendError('',[
                'error'=>true,
                'errors' => $validator->errors()
            ]);
        } else {
            $user = new \App\User([
                'first_name'     => strip_tags($request->input('first_name')),
                'last_name'     => strip_tags($request->input('last_name')),
                'email'    => strip_tags($request->input('email')),
                'password' => strip_tags(Hash::make($request->input('password'))),
                'status'   => 'publish'
            ]);

            if(!setting_item('enable_verify_email_register_user')){
                $user->email_verified_at = Carbon::now();
            }
            $user->save();

            Auth::loginUsingId($user->id);

            event(new Registered($user));

            $user->assignRole('customer');

            $url = $request->headers->get('referer');

            return $this->sendSuccess([
                'error'    => false,
                'messages'  => false,
                'redirect' =>  $url ? $url : home_url()
            ]);

        }
    }
}
