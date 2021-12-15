<?php


namespace Modules\Installer\Listeners;


use App\User;
use Illuminate\Support\Facades\Hash;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;

class EnvironmentSavedListener
{

    public function handle(EnvironmentSaved $event)
    {
        $request = $event->getRequest();
        $user = User::find(1);
        if($user){
            $user->email = $request->input('admin_email');
            $user->password = Hash::make($request->input('admin_password'));
        }
    }
}
