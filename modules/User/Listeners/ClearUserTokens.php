<?php


namespace Modules\User\Listeners;


use Illuminate\Auth\Events\PasswordReset;

class ClearUserTokens
{
    public function handle(PasswordReset $event)
    {
        $user = $event->user;
        if($user){
            $user->tokens()->delete();
        }
    }
}
