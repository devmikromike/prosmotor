<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class CityList extends Model
{
    use HasFactory;

    protected $guarded = [];
    // spublic $response = array();

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
      $response = array();
      $results = [];
      $citylist = [];

        foreach ($cities as $city)
        {
          $res  = Location::city($city)
          ->endDate()
          ->VisitAddress()
          ->get();

          $citylist[] = $city;
          $citylist[$city]['prosCount'] = $res->count();
          $results[] = $res;
        }
       $reponse['prospects'] = $results;  

      return $response = array(
          'proslist' => $reponse['prospects'],
          'citylist' => $citylist
        );
    }
}
