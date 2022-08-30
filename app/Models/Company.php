<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lisense;
use App\Models\CompanyLisense;

class Company extends Model
{
    use HasFactory;
    public $tenantId;

    protected $fillable = [
      'name','vatId','prospect_id',
      'auxiliaryCompany','firm_id',
      'marketing_name','tenant_id'
    ];

    public function users()
  { // Many to many.
    return $this->hasMany(User::class);
  }

    public function lisenses()
  { // returns Collection
    return $this->hasMany(CompanyLisense::class);
  }
  public function lisense()
  { // return One Lisense
    return $this->hasOne(Lisense::class);
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

   public function companyName($id)
   {
      $collection_name  = SELF::where('id', $id)
                   ->select('name')
                   ->get();

      foreach ($collection_name as $key => $value) {
        return($value->name);
      }
   }
}
