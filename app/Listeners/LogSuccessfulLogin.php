<?php

namespace App\Listeners;

use App\Events\lluminate\Auth\Events\Login;
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

    public function __construct()
    {
        //
    }

    public function handle(LoginEvent $event)
    {
        //$event->user->AuthLogin()->update([]);
        $event->user->update([
          'last_login_time' => Carbon::now(),
          'last_login_ip' => request()->getClientIp()
        ]);
        $user->save();
    }
}
