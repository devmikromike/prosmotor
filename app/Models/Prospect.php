<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProsBlackListed;
use App\Models\Contact;

class Prospect extends Model
{
    use HasFactory;

    public $merged;
    public $original = array();
    public $latest;

    protected $guarded = [];

    public function contacts()
    {
      return $this->belongsToMany(Contact::class);
    }


    public function scopeWww($query)
    {
      return $query ->where('www','!=', '');
    }
    public function scopeCode($query, $code)
    {
      $results = $query ->where('bssCode',$code);
      return $results;
    }
    public function bsslineCodes($codes)
    {
      $prosList = [];
      foreach($codes as $code)
      {
        $results = SELF::Code($code['code'])->get();
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
     $data = Prospect::updateOrCreate($company);
     $id = $data->id;
      if (empty($uri)){
        }else {
          ProsDetails::saveUri($uri, $id);
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
         $errors = ProsBlackListed::blacklisted($vatId);
          return $response = array($errors, [
           'message' => 'Failed'
           ]);
         }else {
          $pros = Prospect::collectCompanyData($company,$uri);

         return $response = array($errors, [
           'message' => 'Success, company Found',
           'company_id' => $pros['id'],
           ]);
       };
   }
   public function bssCode($code, $id)
   {
     $pros = SELF::where('id', $id)->first();
     $pros['bssCode'] = $code;
     $saved =  $pros->save();
   }
   public function getId($vatId)
   {
      $id =  SELF::where('vatId', $vatId )->first();
      return $id;
   }
   public function getBssCode($vatId)
   {
      $pros =  SELF::where('vatId', $vatId )->first();
      $save = $pros->toArray();
      $bssCode = $save['bssCode'];

      return   $bssCode;
   }
   public function getNames($vatId)
   {
      $pros =  SELF::where('vatId', $vatId )->first();
      if(!empty($pros['name'])){
        $name = $pros['name'];
        return $name;
      }
   }
   public function getName($vatId)
   {
      $pros =  SELF::where('vatId', $vatId )->first();
      if(!empty($pros['name'])){
        $name = $pros['name'];
        return $name;
      }
   }
   public function saveWww($www_value,$vatId)
   {
     $pros = SELF::getId($vatId);
     $id = $pros ->id;
     $pros['www'] = $www_value;
     $pros->save();

     return $id;
   }
}
