<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Profile;
use App\Models\Lisense;

class AuthUser extends Model
{
    use HasFactory;
    protected $fillable =
    ['last_login_time', 'last_login_ip', 'user_id'];

    public function saveLoginDetails($user, $request)
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
          $user_profiles  = User::where('id', $user->id)
                        ->where('enabled', 1)
                        ->with('profiles')
                        ->get();

          foreach ($user_profiles as $key => $relation_profile) {
            foreach ($relation_profile->profiles as $key => $profile) {
              $user['profileId'] = $profile->id;
              $user['companyId'] = $profile->company_id;
              $user['companyName'] = (new Company())->companyName($user['companyId']);
            }
          }
          $role =  RoleUser::where('user_id', $user->id)
                ->select('role_id')
                ->get();

          $user['roleId'] = RoleUser::roleId($role);        

         return $user;
        } else {  return false; }
    }
}
