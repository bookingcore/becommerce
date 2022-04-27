<?php


namespace Modules\User\Api\V1\User;


use App\Helpers\ReCaptchaEngine;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Modules\User\Resources\UserResource;

class RegisterController extends ApiController
{
    public function index(Request $request){
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

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->sendError('',[
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

            if(!setting_item('enable_email_verification')){
                $user->email_verified_at = Carbon::now();
            }
            $user->save();

            event(new Registered($user));

            $user->assignRole('customer');

            return $this->sendSuccess([
                'data'=>new UserResource($user)
            ]);
        }
    }
}
