<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LoginEvent;
use App\Events\ExtractTimeFrameEvent;
use App\Listeners\TimeFrameBatch;
use App\Events\TimeFrameFinalEvent;
use App\Listeners\TimeFrameListener;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LoginSuccessful;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ExtractTimeFrameEvent::class => [
            TimeFrameBatch::class,
        ],
        TimeFrameFinalEvent::class => [
            TimeFrameListener::class,
        ],
        LoginEvent::class => [
          LogSuccessfulLogin::class,
          LoginSuccessful::class,
      ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
