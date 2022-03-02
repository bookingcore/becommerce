<?php


namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class VerifyEmail extends  \Illuminate\Auth\Notifications\VerifyEmail
{

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(__('Verify Email Address'))
            ->view('user.verify-email',['url'=>$url]);
    }
}
