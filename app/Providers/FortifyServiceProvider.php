<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\RouteFileRegistrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

use App\Models\User;
use App\Models\AuthUser;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
      Fortify::ignoreRoutes();

      $this->app->instance(LogoutResponse::class,
        new class implements LogoutResponse {
          public function toResponse($request)
          {
              return redirect('/');
          }
      });
    }

    public function boot()
    {

          // $this->app->singleton(
          //        \App\Responses\LoginResponse::class
          //    );

        $this->configureRoutes();

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        Fortify::loginView(function () {
          return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
        $user = User::where('email', $request->username)
                    ->orWhere('username', $request->username)
                    ->first();

          if ($user  &&
              Hash::check($request->password, $user->password) &&
              $user->enabled == 1){
                  Log::info('************** step 1 ****************************');
                 (new AuthUser())->saveLoginDetails($user, $request);
                   Log::info('************** step 2 ****************************');
                  $login = (new AuthUser())->loginProcess($user);

                //    (new AuthUser())->saveLoginDetails($user, $request);
                  if(!empty($login))
                  {
                  Log::info('Step 3: reading service provider for Fortify');

                    return $user;
                  } else {
                      return false;
                }
          }   // end of login validation check!
            else {
              return false;
          }
        }); // end of Fortify::authenticateUsing check!
 }
 protected function configureRoutes()
  {


    /*
    Route::group([
                'namespace' => 'Laravel\Fortify\Http\Controllers',
                'domain' => config('fortify.domain', null),
                'prefix' => config('fortify.prefix'),
            ], function () {
                Route::loadRoutesFrom(base_path('routes/auth/fortify.php'));
            });
            */
    }

}
