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
      return $this->belongsToMany(ProsBssLine::class);
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

    public function saveBssProcpect($propectId, $bssModel)
    {
      $pros_bss_line_id = $bssModel;

      dd(($this->bssCodeField())->attach(1));

      $isok = $propectId->bssCodeField()->attach($bssModel->id);
      // $isok = $location->prospects()->attach($propectId);
    //    dd($isok);
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
          return $pros;  // return Model
       };
   }

   public function getId($vatId)
   {
      $pros = (new SELF())->where('vatId', $vatId )->first();
      $save = $pros;

      return $save;
   }
   public function getVatId($propectId)
   {
      $vatId =  (new SELF())->where('id', $propectId )->first();
      return $vatId;
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
