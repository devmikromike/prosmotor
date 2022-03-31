<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\ProsBlackListed;
use App\Models\CityList;
use App\Models\Prospect;
use App\Models\ProsBssLine;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cities()
    {
      return hasMany(CityList::class);
    }
    public function prospects()
    {
      return $this->belongsToMany(Prospect::class);
    }
    public function fields()
    {
      return $this->belongsToMany(ProsBssLine::class);
    }
    public function scopeEndDate($query)
    {
      return $query ->where('endDate',NULL);
    }
    public function scopeCity($query, $city)
    {
      return $query ->where('city', $city);
    }
    public function scopeVisitAddress($query)
    {
      return $query ->where('type',1);
    }
    public function scopePostalAddress($query)
    {
      return $query ->where('type',2);
    }
    public function scopeCareOf($query)
    {
      return $query ->where('careOf','!=', '');
    }
    public function scopeLastVersion($query)
    {
      return $query ->where('endDate','!=', '');
    }
    public function extractLocation($data, $propectId)
    {
        if(is_array($data['addresses'])){
            $locations = $data['addresses'];
            foreach ($locations as $loc){
              if((new SELF())->checkIfExistAddress($loc) == 'empty'){
                if($loc['street']!= null)
                {
                  $street = $loc['street'];
                  if((new SELF())->postBoxIsNotExist($street)== 'true') {
                      $location = (new SELF())->createLocation($propectId, $loc);
                       $location->prospects()->attach($propectId);
                   }else {
                     $vatId = (new Prospect())->getVatId($propectId);
                               (new ProsBlackListed())->blacklisted($vatId);
                   }
                 }
               }
             }
           }else {
            $vatId = (new Prospect())->getVatId($propectId);
                      (new ProsBlackListed())->blacklisted($vatId);
         }


/*
            // relation Location and Pros_id
           if ($isNotNull == true)  // Empty endDate !
           {
          //   dump($isNotNull);
               $location = (new SELF())->createLocation($propectId, $loc);
                   if(!empty($location && $propectId)){
                     $isok = $location->prospects()->attach($propectId);
                   }
          //   $isok = $location->prospects()->attach($propectId);
        }else {                                   // end of 2nd IF!
                 return;
                            }
              }                                  // end of Foreach
          }
            else {                                // end of 1st IF
               $locations = 'Ei osoite tietoja.';
                return;                                   // Return No Address details!
        }   */

        // $avail =  (new SELF())->postBox($street);

        // dump($avail);
        //
        //  $vatId = $propectId;
        //
        //   if(!empty($street) && $avail == "false"){
        //       $addss = (new SELF())->saveLocation($address, $propectId);
        //           return   $addss;
        //         }else {
        //       $vatId = (new Prospect())->getVatId($propectId);
        //         (new ProsBlackListed())->blacklisted($vatId);
        //         dump('ProsBlackListed:empty($street) ');
        //     return;
        //   }









   }   // End of function
    public function createLocation($propectId, $loc)
    {
        $address['careOf'] = $loc['careOf'];
        $address['street'] = $loc['street'];
        $address['postCode'] = $loc['postCode'];
        $address['type'] = $loc['type'];
        $address['city'] = $loc['city'];
        $address['country'] = $loc['country'];
        $address['regDate'] = $loc['registrationDate'];
        // if endDate is null, it is last one!
        $address['endDate'] = $loc['endDate'];
        $street = $address['street'];
        $addss =  (new SELF())->saveLocation($address, $propectId);
        return   $addss;

        // $avail =  (new SELF())->postBox($street);

        // dump($avail);
        //
        //  $vatId = $propectId;
        //
        //   if(!empty($street) && $avail == "false"){
        //       $addss = (new SELF())->saveLocation($address, $propectId);
        //           return   $addss;
        //         }else {
        //       $vatId = (new Prospect())->getVatId($propectId);
        //         (new ProsBlackListed())->blacklisted($vatId);
        //         dump('ProsBlackListed:empty($street) ');
        //     return;
        //   }
    }
    public function checkIfExistAddress($location)
    {
      if ($location['endDate'])
      {
        return 'exist';    // EndDate exist!
      }else {
        return 'empty';    // EndDate Empty
      }
    }
    public function saveLocation($address, $propectId)
    {
      $city = $address['city'];
      (new CityList())->saveCity($city);
      $addss = (new SELF())->updateOrCreate($address);
     return $addss;
    }
    public function postBoxIsNotExist($street)
    {
           if(Str::contains($street,"PL")){
              return "exist";
            }
            if(Str::contains($street,"PB")){
               return "exist";
             }
             if(Str::contains($street,"BOX")){
                return "exist";
             }
        return "true";
    }
}
