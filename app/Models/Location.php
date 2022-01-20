<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\ProsBlackListed;
use App\Models\CityList;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cities()
    {
      return hasMany(CityList::class);
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
    public function extractLocation($data)
    {
    //   dump ("Extract Location data. "  );
       $id = $data['businessId'];

        if(!empty($data['addresses'])){
          $locations = $data['addresses'];
          foreach ($locations as $loc){
      //  dump ("Creating Location data. "  );
        SELF::createLocation($id, $loc );
        }
      }
   }
    public function createLocation($id, $loc)
    {
        $address['vat_id'] = $id;
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
    //    dump ("Check if Address has Box info or not. "  );
        $avail =  SELF::postBox($street);

          if(!empty($street) && $avail == "false"){

            $addss =  SELF::saveLocation($address);
      //      dump( "Return saving Location data.... ");
            return $addss;
      }else {
        $vatId = $address['vat_id'];
        ProsBlackListed::blacklisted($vatId);
       }
    }
    public function saveLocation($address)
    {
      $city = $address['city'];
//      dump( "Saving city to citylist .... ");
      CityList::saveCity($city);

  //    dump( "Saving Location .... ");
      $addss = SELF::updateOrCreate($address);
       return $addss;
    }

    public function postBox($address)
    {
          if(empty($address)){
    //          dump("No Addess detail found  .... ");
              return "true";
            }
           if(!empty($address && Str::contains($address,"PL") )){
      //        dump("Found PL from  Location .... ");
                return "true";
            }
            if(!empty($address && Str::contains($address,"PB") )){
        //         dump("Found PB from  Location .... ");
                 return "true";
             }
             if(!empty($address && Str::contains($address,"BOX") )){
          //      dump("Found BOX from  Location .... ");
                  return "true";
             }

  //   dump("Not found BOX info from Address .... Fine to Proceed!");

        return "false";
    }
}
