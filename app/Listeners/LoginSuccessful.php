<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoginSuccessful
{

    public function __construct()
    {
        //
    }

    public function handle(LoginEvent $event)
    {
      // Log::info('am I logged in!');
      if ($event->user->auth()) {

        }
    }
}
