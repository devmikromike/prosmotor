<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\User;
use App\Models\AuthUser;
use App\Models\Profile;
use App\Models\Lisense;

class AuthUser extends Model
{
    use HasFactory;
    protected $fillable =
    ['last_login_time', 'last_login_ip', 'user_id'];

    public function  saveLoginDetails($user, $request)
    {
        $user['last_login_ip'] =   $request->ip();
        $user['last_login_time'] = \Carbon\Carbon::now();
        $user->update();
      return 1;
    }

    public function loginProcess($user)
    {
        $validLisense = Lisense::where('user_id', $user->id)
                      ->where('status', 'active')
                        ->first();
        if(!empty($validLisense))
        {
         return $user;
        } else {  return false; }

      /*
          $profileCollection = $user->profile;

          foreach ($profileCollection as $profile )
          {
            // search lisenses from company_id
            // match lisense for user _id
            $companyId = $profile->company_id;
            $company = Company::where('id', $companyId)->first();

            $lisenses = $company->lisenses()->get();
              foreach ($lisenses as $key => $lisense) {

                $lisenseId = $lisense->lisense_id;
                $validLisense = Lisense::where('user_id', $user->id)
                //where('id', $lisenseId)

                ->where('status', 'active')
            //    ->where('user_id', $user->id)
                ->first();

                  if(!empty($validLisense))
                  {
                    return $user;
                  }

           } // // end of Lisese validation check!
           return false;
        }   */
    }
}
