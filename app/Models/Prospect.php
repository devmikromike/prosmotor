<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Session;
use App\Models\ProsBlackListed;
use App\Models\ProsBssLine;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Register;

class Prospect extends Model
{
    use HasFactory;

    public $merged;
    public $original = array();
    public $latest;

    protected $fillable = [
      'name', 'vatId', 'bssCode','www','registrationDate',
      'status'
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
    public function registers()
    {
      return $this->belongsToMany(Register::class);
    }
    public function codeField($id)
    {
      $codeModel = ProsBssLine::find('prospect_id', $id);

    }
/************
*  Start Scopes
*/
    public function scopeCountPropects($query)
    {
      return $query
      ->count();
    }


    public function scopeProsAll($query)
    {
      return $query
      ->orderBy('id')
      ->get();
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

    /************
    *  End Scopes
    */
    public function saveBssProspect($propectId, $bssModel)
    {
      $pros_bss_line_id = $bssModel;

    //  dd(($this->bssCodeField())->attach(1));

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
     Log::info('step 35: Black sack process: [Propect Created]'.$company['vatId']);

     $id = $data->id;
      if (empty($uri)){
        }else {
          (new ProsDetails())->saveUri($uri, $id);
        };
      //  dump($data);
      /*  if (empty($id)){
          dump('empty');
        //  dd($data);
      }   */

     return $data;
   }
   public function emptyCompanyName($company, $uri, $businessChanges)
   {

     $name = $company['name'];
     $vatId = $company['vatId'];
     $errors = array();
     $success = array();

     if (empty($name))
       {
          Log::error('Black sack extraction process: [CompanyName NOT Found] '.$vatId);
         $reason = 'No Company name on PRH Record for Vatid.';
         $errors = (new ProsBlackListed())->blacklisted($vatId, $reason);
          return $response = array($errors, [
           'message' => 'Failed',
           'id' => 'failed'
           ]);
         }else {
      //     Log::info('step 34: Black sack extraction process: [CompanyName Found]');
          $prospectModel = (new Prospect())->collectCompanyData($company,$uri);

           //   return $response = array($success, [
          return array($success, [
          'message' => 'created propect successfully',
          'prospect' =>  $prospectModel  // return Model
          ]);
       }
   }
   public function status()
   {  // retun status = 200
     $response['status'] = 200;
     return $response;
   }

   public function getId($vatId)
   {

      $pros = (new SELF())->where('vatId', $vatId )->first();
      return $pros;
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
   public function getName($name)
   {
      $names = array();
      $prospects =  (new SELF())->where('name', 'LIKE', "%{$name}%" )->get();

       $sum = (new Search())->counter($prospects);
      if($sum == 1){
        foreach ($prospects as $pros)
        {
              $response['id'] = $pros['id'];
              $response['name'] = $pros['name'];
              $response['vatId'] = $pros['vatId'];
              $response['www'] = $pros['www'];
              $response['registrationDate'] = $pros['registrationDate'];
              $response['sum'] = $sum;
                session()->put('message', 'Search in progress.....');
            return $response;
         }
       }else {
         if($sum > 1){
              $prospects['sum'] = $sum;
             session()->put('message', 'Search in progress,..'.$name. ' found multiable times '.$sum);
             return $prospects;
         }
         /* Failed, Sum is zero!*/
          $response['sum'] = $sum;
          session()->put('message', 'Search in progress,..'.$name. ' not found ');

         return $response;
       }
   }
   public function saveWww($www_value, $vatId)
   {
     $pros = (new SELF())->getId($vatId);
       $id = $pros['vatId'];
       $pros['www'] = $www_value;
       $pros->save();
     return $id;
   }
}
