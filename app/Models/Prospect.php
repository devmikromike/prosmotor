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

    public function scopeWww($query)
    {
      return $query ->where('www','!=', '');
    }
    public function scopeCode($query, $code)
    {
      return $query ->where('bssCode',$code);
    }


    public function scopeSearch($query, $term)
    {
      $term = "%$term%";
      $query ->where(function($query) use ($term){
        $query->where('name','like',$term)
        ->orWhere('vatId','like',$term)
        );

      }


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

   }
   public function saveWww($www_value,$vatId)
   {
     dump ($vatId);
       $pros_id = SELF::where('vatId', $vatId)->get('id');
      $flat =  $pros_id ->flatten();

      $pros = SELF::find($vatId, 'vatId');
       dump($flat, $pros_id);
      //$pros->www = $www_value;
      //$pros->save();



   }
}
