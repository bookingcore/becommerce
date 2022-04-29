<?php

namespace Modules\User\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\RegisteredEmail;

class UserEventSubscriber
{
    const CODE = [
        'first_name' => '[first_name]',
        'last_name'  => '[last_name]',
        'name'       => '[name]',
        'email'      => '[email]',

    ];

    public function handleUserRegister($event){


        if (!empty(setting_item('enable_mail_user_registered'))) {
            $body = $this->replaceContentEmail($event, setting_item_with_lang('user_content_email_registered',app()->getLocale()));
            Mail::to($event->user->email)->locale(app()->getLocale())->queue(new RegisteredEmail($event->user, $body, 'customer'));
        }


        if (!empty(setting_item('admin_email') and !empty(setting_item_with_lang('admin_enable_mail_user_registered',app()->getLocale())))) {
            $body = $this->replaceContentEmail($event, setting_item_with_lang('admin_content_email_user_registered',app()->getLocale()));
            Mail::to(setting_item('admin_email'))->queue(new RegisteredEmail($event->user, $body, 'admin'));
        }
    }

    public function handleUserVerified($event){
        if (!$event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }
    public function subscribe($events)
    {
        $events->listen(
            Registered::class,
            [UserEventSubscriber::class, 'handleUserLogin']
        );

        $events->listen(
            Verified::class,
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }


    public function replaceContentEmail($event, $content)
    {
        if (!empty($content)) {
            foreach (self::CODE as $item => $value) {
                $content = str_replace($value, @$event->user->$item, $content);
            }
        }
        return $content;
    }
}
