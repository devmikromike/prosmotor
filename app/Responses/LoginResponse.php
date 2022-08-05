<?php

namespace App\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use App\Models\User;
use App\Models\AuthUser;
use App\Models\Profile;
use App\Models\Lisense;


class LoginResponse implements LoginResponseContract
{

  public $company = [];
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // Log::info('step 4: Login Response');
        $user = Auth::user();
        $profileCollection = $user->profile;
        foreach ($profileCollection as $profile )
        {

          $company = Company::where('id', $profile->company_id)->first();
            $request->session()->put('user.companyName' ,
                                      $company->name);
            $request->session()->put('user.ProfileId' ,
                                      $profile->id);


            // dd($company->name);

        }
    //    $request->session()->push('user.companyId' , $companyId);


        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->route('welcome');
        //    : redirect('/');
    //          : redirect($home);
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
