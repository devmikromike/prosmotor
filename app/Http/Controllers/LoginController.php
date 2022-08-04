<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Illuminate\Routing\Pipeline;
use App\Http\Controllers\AuthController as Controller;
use App\Responses\LoginResponse;
use App\Http\Requests\Login;

class LoginController extends Controller
{
    public function store(Login  $request)
    {
      return $this->loginPipeline($request)->then(function ($request){
        return app(LoginResponse::class);
         });
    }
    protected function loginPipeline(Login $request)
   {
       if (Fortify::$authenticateThroughCallback) {
           return (new Pipeline(app()))->send($request)->through(array_filter(
               call_user_func(Fortify::$authenticateThroughCallback, $request)
           ));
       }

       if (is_array(config('fortify.pipelines.login'))) {
           return (new Pipeline(app()))->send($request)->through(array_filter(
               config('fortify.pipelines.login')
           ));
       }

       return (new Pipeline(app()))->send($request)->through(array_filter([
           config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
           Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
           AttemptToAuthenticate::class,
           PrepareAuthenticatedSession::class,
       ]));
   }
}
