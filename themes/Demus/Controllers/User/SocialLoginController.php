<?php


namespace Themes\demus\Controllers\User;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Themes\demus\Controllers\FrontendController;

class SocialLoginController extends FrontendController
{
    public function login($provider)
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

    public function callback($provider)
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
}
