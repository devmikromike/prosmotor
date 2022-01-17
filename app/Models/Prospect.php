<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProsBlackListed;
use App\Models\Contact;

class Prospect extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeHasCity($city)
    {
      return $query ->where('bssCode',$code);
    }

    public function scopeWww($query)
    {
      return $query ->where('www','!=', '');
    }
    public function scopeCode($query, $code)
    {
      return $query ->where('bssCode',$code);
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
   public function saveWww($www_value,$vatId)
   {
     $pros = SELF::getId($vatId);
     $id = $pros ->id;
     $pros['www'] = $www_value;
     $pros->save();

     return $id;
   }
}
