<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;

class Lisense extends Model
{
    use HasFactory;

    protected $fillable = [
      'type_id', 'key', 'user_id',
      'status'
    ];
    /*
    protected $casts = [
    'actived_at' => 'datetime',
    'expired_at' => 'datetime',
  ]; */

  protected $casts = [
  'actived_at',
  'expired_at'
  ];
  public function company()
  { // Many to many.
    return belongsTo(Company::class);
  }
}
