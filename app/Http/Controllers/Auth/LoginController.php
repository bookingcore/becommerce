<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if(Auth::user()->hasPermission('setting_update')){
            return '/admin';
        }else{
            return $this->redirectTo;
        }
    }

    public function socialLogin($provider)
    {
        $this->initConfigs($provider);
        return \Laravel\Socialite\Facades\Socialite::driver($provider)->redirect();
    }

    protected function initConfigs($provider)
    {
        switch($provider){
            case "facebook":
            case "google":
            case "twitter":
                config()->set([
                    'services.'.$provider.'.client_id'=>setting_item($provider.'_client_id'),
                    'services.'.$provider.'.client_secret'=>setting_item($provider.'_client_secret'),
                    'services.'.$provider.'.redirect'=>'/social-callback/'.$provider,
                ]);
            break;
        }
    }

    public function socialCallBack($provider)
    {
        $this->initConfigs($provider);

        $user = \Laravel\Socialite\Facades\Socialite::driver($provider)->user();

        if(empty($user)){
            return redirect()->route('/login')->with('error',__('Can not authorize'));
        }

        $existUser = User::getUserBySocialId($provider,$user->getId());

        if(empty($existUser)){
            //Try login with social email
            $email = $user->getId().'@'.$provider.'.com';

            $userByEmail = User::where(['email'=>$email])->first();
            if(!empty($userByEmail)){
                if(in_array($userByEmail->status,['blocked'])){
                    return redirect()->route('/login')->with('error',__('Your account has been blocked'));
                }
                Auth::login($userByEmail);
                return redirect('/');
            }


            // Create New User
            $realUser = new User();
            $realUser->email = $user->getId().'@'.$provider.'.com';
            $realUser->password = Hash::make(uniqid().time());
            $realUser->name = $user->getName();
            $realUser->first_name = $user->getName();
            $realUser->status = 'publish';
            $realUser->email_verified_at = Carbon::now();

            $realUser->save();

            $realUser->addMeta('social_'.$provider.'_id',$user->getId());
            $realUser->addMeta('social_'.$provider.'_email',$user->getEmail());
            $realUser->addMeta('social_'.$provider.'_name',$user->getName());
            $realUser->addMeta('social_'.$provider.'_avatar',$user->getAvatar());

            $realUser->assignRole('customer');

            // Login with user
            Auth::login($realUser);

            return redirect('/');

        }else{

            if($existUser->deleted == 1){
                return redirect()->route('/login')->with('error',__('User blocked'));
            }

            Auth::login($existUser);

            return redirect('/');
        }
    }


    public function showLoginForm()
    {
        return view('auth.login',[
            'page_title'=>__("Login")
        ]);
    }
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return $request->wantsJson()
            ? new JsonResponse(['redirect'=>(string) $request->input('redirect','/')], 200)
            : redirect()->intended($this->redirectPath());
    }
}
