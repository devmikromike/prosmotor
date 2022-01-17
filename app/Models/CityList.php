<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class CityList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function locations()
    {
      return hasMany(Location::class);
    }


    public function scopeCitySearch($query, $city)
    {
      return $query ->where('name','=', $city);
    }
    public function scopeCityAll($query)
    {
      return $query ->get()->toArray();
    }
    public function saveCity($city)
    {
      $c = SELF::firstOrCreate([
        'name' => $city,
      ]);
      return $c;
    }
    public function cityList($cities)
    { // getting collection $cities
      $sum = $cities->count();
      if($sum === 1)
      {
        $response = array();
        foreach ($cities as $city)
        {
          $res = Location::city($city);
        }
        $reponse['prospects'] = $res ->toArray();
        $reponse['counts'] = $res->count();

      return $response = array(
          'prospects' => $reponse['prospects'],
          'counts' => $reponse['counts']
        );
      }
    }
}
