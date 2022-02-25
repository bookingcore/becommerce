<?php

namespace Themes\Base\Controllers;

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
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->sendError('',[
                'error'=>true,
                'errors' => $validator->errors()
            ]);
        } else {
            $user = \App\User::create([
                'first_name'     => strip_tags($request->input('first_name')),
                'last_name'     => strip_tags($request->input('last_name')),
                'email'    => strip_tags($request->input('email')),
                'password' => strip_tags(Hash::make($request->input('password'))),
                'status'   => 'publish'
            ]);
            Auth::loginUsingId($user->id);
            try {

                event(new SendMailUserRegistered($user));

            }catch (Exceptio $exception){
                Log::warning("SendMailUserRegistered: ".$exception->getMessage());
            }
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
