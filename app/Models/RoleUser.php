<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function roleId($role)
    {
      foreach ($role as $key => $value) {
          return $value->role_id;
      }
    }
}
