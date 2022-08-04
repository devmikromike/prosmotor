<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
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

    public $validLisense;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
  //      Fortify::ignoreRoutes();

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

               (new AuthUser())->saveLoginDetails($user, $request);
               $login = (new AuthUser())->loginProcess($user);
              //
              //   $profileCollection = $user->profile;
              //
              //   foreach ($profileCollection as $profile )
              //   {
              //     // search lisenses from company_id
              //     // match lisense for user _id
              //     $companyId = $profile->company_id;
              //     $company = Company::where('id', $companyId)->first();
              //
              //     $lisenses = $company->lisenses()->get();
              //       foreach ($lisenses as $key => $lisense) {
              //
              //         $lisenseId = $lisense->lisense_id;
              //         $validLisense = Lisense::where('id', $lisenseId)
              //
              //         ->where('status', 'active')
              //         ->where('user_id', $user->id)
              //         ->first();
              //
              //           if(!empty($validLisense))
              //           {
              //             return $user;
              //           }
              //
              //    } // // end of Lisese validation check!
              //    return false;
              // }
                if(!empty($login))
                {
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
}
