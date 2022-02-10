<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProsBlackListed;
use App\Models\ProsBssLine;
use App\Models\Contact;
use App\Models\Location;

class Prospect extends Model
{
    use HasFactory;

    public $merged;
    public $original = array();
    public $latest;

    protected $fillable = [
      'name', 'vatId', 'bssCode','www','registrationDate'
    ];

    public function contacts()
    {
      return $this->belongsToMany(Contact::class);
    }
    public function locations()
    {
      return $this->belongsToMany(Location::class);
    }
    public function bssCodeField()
    {
      return $this->hasOne(ProsBssLine::class);
    }
/************
*  Start Scopes
*/
    public function scopeWww($query)
    {
      return $query ->where('www','!=', '');
    }
    public function scopeCode($query, $code)
    {
      $results = $query ->where('bssCode',$code);
      return $results;
    }

    /************
    *  End Scopes
    */

    // rearrange logic for citylist and idsList
    public function prosCities()
    { // selected cities for Prospect List
      // foreach
      // return single city

    }


    public function bsslineCodes($codes)
    {
      $prosList = [];
      foreach($codes as $code)
      {
        $results = (new SELF())->Code($code['code'])->get();
        $prosList[] = $results;
      }
      return $prosList;
    }

    public function scopeSearch($query, $term)
    {  /*
      $term = "%$term%";
      $query ->where(function($query) use ($term){
        $query->where('name','like',$term)
        ->orWhere('vatId','like',$term));

      }
      */

      //return $query ->where('bssCode',$code);
    }

  public function addName($pros, $key)
  {
    dump($key);

    if ($key == 0)
    {
       $original = array($pros);
    }

    if ($key == 1)
    {
      dd($original);

    //  $lst = new Collection($prospects);
    //  $merged = $original->merge($lst);

    }
    if ($key > 1)
    {
      /*
      $latest = Collection($prospects);
      $merged = $original->merge($latest);
      $merged ->all();
      dd($merged);   */
    }
  }


   public function collectCompanyData($company,$uri)
   {
     $data = (new Prospect())->updateOrCreate($company);
     $id = $data->id;
      if (empty($uri)){
        }else {
          (new ProsDetails())->saveUri($uri, $id);
        }
     return $data;
   }
   public function emptyCompanyName($company, $uri)
   {
     $name = $company['name'];
     $vatId = $company['vatId'];
     $errors = array();
     $pros = array();

     if (empty($name))
       {
         $errors = (new ProsBlackListed())->blacklisted($vatId);
          return $response = array($errors, [
           'message' => 'Failed'
           ]);
         }else {
          $pros = (new Prospect())->collectCompanyData($company,$uri);

         return $response = array(
           'message' => 'Success, company Found',
           'company_id' => $pros['id'],
           );
       };
   }
   /*
   public function bssCode($code, $prosId)
   {
    //  renew this, no bsscode anymore in Prospect table.
     $pros = (new SELF())->where('id', $prosId)->first();
     $pros['bssCode'] = $code;
     $saved =  $pros->save();
   } */
   public function getId($vatId)
   {
      $pros = (new SELF())->where('vatId', $vatId )->first();
      $save = $pros;

      return $save;
   }
   public function getVatId($prosId)
   {
      $vatId =  (new SELF())->where('id', $prosId )->first();
      return $vatId;
   }
   public function getBssCode($vatId)
   {/* renew this, no bsscode anymore in Prospect table.
      $pros =  (new SELF())->where('vatId', $vatId )->first();
      $save = $pros->toArray();
      $bssCode = $save['bssCode'];

      return   $bssCode; */
   }
   public function getNames($vatId)
   {
      $pros =  (new SELF())->where('vatId', $vatId )->first();
      if(!empty($pros['name'])){
        $name = $pros['name'];
        return $name;
      }
   }
   public function getName($vatId)
   {
      $pros =  (new SELF())->where('vatId', $vatId )->first();
      if(!empty($pros['name'])){
        $name = $pros['name'];
        return $name;
      }
   }
   public function saveWww($www_value,$vatId)
   {
     $pros = (new SELF())->getId($vatId);
     $id = $pros['vatId'];
     $pros['www'] = $www_value;
     $pros->save();
     return $id;
   }
}
