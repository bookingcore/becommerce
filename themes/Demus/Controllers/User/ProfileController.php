<?php


namespace Themes\demus\Controllers\User;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Themes\demus\Controllers\FrontendController;

class ProfileController extends FrontendController
{

    public function index(){
        $data = [
            'user'=>auth()->user(),
            'page_title'=>__("Update Account Information"),
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'name'=>__("My Account")
                ],
                [
                    'name'=>__("Account Information")
                ],
            ],
        ];
        return view('user.profile',$data);
    }

    public function store(Request $request){

        $user = auth()->user();
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'business_name'  => 'required|max:255',
            'email'      => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ],[
            'business_name.required'=>__("Display name is required")
        ]);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->business_name = $request->input('business_name');
        $user->email = $request->input('email');

        $user->save();

        return back()->with("success",__("Account information updated"));
    }
}
