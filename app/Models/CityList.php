<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Location;
use App\Models\Prospect;

class CityList extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected  $table = 'city_lists';
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
      return $query
      ->orderBy('name')
      ->get();
    }
    public function scopeCountCities($query)
    {
      return $query
      ->count();
    }
    public function saveCity($city)
    {
      $c = (new SELF())->firstOrCreate([
        'name' => $city,
      ]);
      return $c;
    }
    public function loadCities()
    {
    //  (new SELF())->paganation(10)->get();
    }
    public function prosCityList($cities)
    { // getting data from prospect.index component with $cities

      $response = array();
      $results = [];
      $citylist = [];

        foreach ($cities as $city)
        {
           $res = (new Location())
            ->city($city)
            ->with('prospects')
            ->endDate()
            ->VisitAddress()
            ->get();

          $citylist[] = $city;
          $results[] = $res;
        }

        $response = array(
            'proslist' => $results,
            'citylist' => $citylist,
        );

         return  $response;
    }
}
