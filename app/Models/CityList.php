<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityList extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function saveCity($city)
    {

      $c = SELF::firstOrCreate([
        'name' => $city,
      ]);
      //  if (SELF::where('name', $city)->exists()) {
      //  }

      return $c;
    }
}
