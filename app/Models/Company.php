<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Company extends Model
{
    use HasFactory;
    public $tenantId;

    protected $fillable = [
      'name','vatId','prospect_id',
      'auxiliaryCompany','firm_id',
      'marketing_name','tenant_id'
    ];

    public function Users()
  { // Many to many.
    return hasMany(User::class);
  }
  public function firmId($query, $tenantId)
  {  /* Return firmId */
    // return hasMany(User::class);
  }
  /*
  public function firmId($query, $tenantId)
  {  /* Return firmId */
    // return hasMany(User::class);
   /* } */
}
