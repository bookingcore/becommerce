<?php

namespace Themes\Base\Controllers\User;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Themes\Base\Controllers\FrontendController;

class PasswordController extends FrontendController
{

    use ResetsPasswords;
    public function index(){
        $data = [
            'page_title'=>__("Change Password"),
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'name'=>__("My Account")
                ],
                [
                    'name'=>__("Change Password")
                ],
            ],
            'user'=>\auth()->user()
        ];
        return view('user.change-password',$data);
    }

    public function store(Request $request){

        $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->input('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
        }
        if (strcmp($request->input('current-password'), $request->input('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", __("New Password cannot be same as your current password. Please choose a different password."));
        }
        //Change Password
        $user = Auth::user();
        $this->resetPassword($user,$request->input('new-password'));

        return redirect()->back()->with('success', __('Password changed successfully !'));
    }
}
