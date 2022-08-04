<?php

namespace App\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Log;


class LoginResponse implements LoginResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // replace this with your own code
        // the user can be located with Auth facade

    //    $home = Auth::user()->is_admin ? config('fortify.dashboard') : config('fortify.home');
        //$home = Auth::user()->is_admin ? config('fortify.dashboard') : config('fortify.home');
  Log::info('step 4');
        dd('hit');
            Log::info('step 4');

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect($home);
    }

}

/*
The next step it to modify JetstreamServiceProvider to use your LoginReponse
*/

// public function boot()
// {
//     $this->configurePermissions();
//
//     Jetstream::deleteUsersUsing(DeleteUser::class);
//
//     // register new LoginResponse
//     $this->app->singleton(
//         \Laravel\Fortify\Contracts\LoginResponse::class,
//         \App\Http\Responses\LoginResponse::class
//     );
// }
