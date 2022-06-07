<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CityList;
use App\Models\Location;

class PostCodeList extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'post_code_lists';

    public function cities()
    {
      return $this->belongsToMany(CityList::class, 'post_code_lists',
                                        'city_lists_id','postalCode');
    }
    public function createPostalCode($postalCode, $cityID)
    {
      if(!empty($postalCode))
      {
        SELF::updateOrCreate([
          'city_lists_id' => $cityID,
          'postalCode' => $postalCode
        ]);
        return ;
      }
      return 0;

      //   $this->cities()->attach($cityID);
      // dd($postalCode, $cityID);
    }
}
