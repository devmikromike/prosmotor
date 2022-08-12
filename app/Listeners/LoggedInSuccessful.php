<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoggedInSuccessful
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
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
      if (Auth::check()) {
          Log::info('am I logged in!');
        }
        Session::flash('login-success',
        'Hello '
        . $event->user->name .
        ', welcome back!');
    }
}
