<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Booking\Events\VendorLogPayment;
use Modules\Booking\Listeners\VendorLogPaymentListen;
use Modules\Installer\Listeners\EnvironmentSavedListener;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Listeners\SendMailUserRegisteredListen;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
        SendMailUserRegistered::class => [
            SendMailUserRegisteredListen::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
