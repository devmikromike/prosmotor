<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// use lluminate\Auth\Events\Login;
use App\Events\LoginEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;

class LogSuccessfulLogin
{
    private $profile;

    public function __construct()
    {
        //
    }

    public function handle(LoginEvent $event)
    {
      /*
        $event->user->update([
          'last_login_time' => Carbon::now(),
          'last_login_ip' => request()->getClientIp()
        ]);
         $event->user->save();
         $profile = $event->user->profile;
         dump($profile);   */
    }
}
