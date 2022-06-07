<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\ProsBlackListed;
use App\Models\CityList;
use App\Models\Prospect;
use App\Models\ProsBssLine;
use App\Models\PostCodeList;

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
              $type = $loc['type'];
              if((new SELF())->checkIfExistEndDate($loc) == 'empty'){
                if($loc['street']!= null)
                {
                  $street = $loc['street'];
                  if((new SELF())->IsStreetExist($street, $type)== 'true') {
                      $location = (new SELF())->createLocation($propectId, $loc);
                       $location->prospects()->attach($propectId);
                   }else {
                     $reason = 'No address found';
                     $vatId = (new Prospect())->getVatId($propectId);
                               (new ProsBlackListed())->blacklisted($vatId, $reason);
                   } //  $reason = 'No address found';
                 } // loc['street']!= null
               } // checkIfExistEndDate
             } /// End of Foreach.
           }else {
            $reason = 'No visit or postal address found';
            $vatId = (new Prospect())->getVatId($propectId);
                      (new ProsBlackListed())->blacklisted($vatId);
         }
   }   // End of function

    public function IsStreetExist($street, $type)
    {
        if($type == 1)
        {
          $visit = SELF::visitAddressIsExist($street);
          return $visit;
        }
        if($type == 2)
        {
            $postal = SELF::postalAddressIsNotExist($street);

           return $postal;
        }
    }
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
          $cityModel = (new CityList())->saveCity($loc['city']);
           (new PostCodeList())->createPostalCode(($loc['postCode']),$cityModel->id);
        return   $addss;

    }
    public function checkIfExistEndDate($location)
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
      $addss = (new SELF())->updateOrCreate($address);
     return $addss;
    }
    public function postBoxIsNotExist($street)
    {
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
    public function coIsNotExist($street)
    {
      if(Str::contains($street,"c/o")){
         return "exist";
      }else {
        return true;
      }
    }
    public function postalAddressIsNotExist($street)
    {
        if(SELF::postBoxIsNotExist($street)){
          if(SELF::coIsNotExist($street)){
            return true;
        }else {
          return false;
        }
      }
    }
    public function visitAddressIsExist($street)
    {
      if(SELF::postBoxIsNotExist($street)== true){
        if(SELF::coIsNotExist($street)== true){
          return true;
        }
      }else {
        return false;
      }
    }
}
