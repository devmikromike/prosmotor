<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AuthUser;
use App\Models\Profile;
use App\Models\RoleUser;
use App\Models\Company;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'last_login_ip',
        'last_login_time'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = ['last_login_time'];

  public function role()
  {
    return $this->belongTo(RoleUser::class,'role_id','user_id');
  }
    public function companies()
  { // Many to many.
    return $this->hasMany(Company::class);
  }
    public function LoggedIn($user)
  {
   // Return Company_id
  }
    public function LoggedInUser($company_id)
  {
   // Return Firm_id
   // Firm_id  Return tenant_id
   // -> Firm_list [] -> // Return AuxCompanies []
  }
    public function is_ActiveUser($user)
  {
   // Return tinyInt 0 / 1
  }
    public function profiles()
  {
    return $this->hasMany(Profile::class);
  }

}
