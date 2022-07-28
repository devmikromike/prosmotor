<?php

namespace App\Listeners;

use App\Events\lluminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use lluminate\Auth\Events\Login;
use App\Models\User;
use Carbon\Carbon;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\lluminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //$event->user->AuthLogin()->update([]);
        $event->user->update([
          'last_login_time' => Carbon::now(),
          'last_login_ip' => request()->getClientIp()
        ]);
        $user->save();

    }
}
