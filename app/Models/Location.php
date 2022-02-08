<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\ProsBlackListed;
use App\Models\CityList;
use App\Models\Prospect;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cities()
    {
      return hasMany((new CityList())->class);
    }
    public function prospects()
    {
      return $this->belongsToMany((new Prospect())->class);
    }
    public function scopeEndDate($query)
    {
      // return only EndDates
      //      return $query ->where('endDate','>', 0);

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
    public function extractLocation($data, $prosId)
    {
       // $id = $data['businessId']; // removed.

        if(!empty($data['addresses'])){
          $locations = $data['addresses'];
          foreach ($locations as $loc){
          $location = (new SELF())->createLocation($prosId, $loc);
          $isNotNull = (new SELF())->checkIfExistAddress($location);

          // relation Location and Pros_id
          if ($isNotNull === 'true')
          {
            $isok = $location->prospects()->attach($prosId);
          }
        }
      }else {
        $locations = 'Ei osoite tietoja.';
      }
   }
    public function createLocation($prosId, $loc)
    {
        // $address['vat_id'] = $id; // Removed
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
        $avail =  (new SELF())->postBox($street);

          if(!empty($street) && $avail == "false"){
            $addss =  (new SELF())->saveLocation($address, $prosId);
            return $addss;
            }else {
              $vatId= (new Prospect())->getVatId($prosId);
              (new ProsBlackListed())->blacklisted($vatId);
             }
    }
    public function checkIfExistAddress($location)
    {
      // dd($location);

      if (empty($location->endDate))
      {
        return true;
      }else {
        return false;
      }
      // dd($location);
    }
    public function saveLocation($address, $prosId)
    {
      $city = $address['city'];
      (new CityList())->saveCity($city);
      $addss = (new SELF())->updateOrCreate($address);
     return $addss;
    }
    public function postBox($address)
    {
          if(empty($address)){
              return "true";
            }
           if(!empty($address && Str::contains($address,"PL") )){
              return "true";
            }
            if(!empty($address && Str::contains($address,"PB") )){
               return "true";
             }
             if(!empty($address && Str::contains($address,"BOX") )){
                return "true";
             }
        return "false";
    }
}
