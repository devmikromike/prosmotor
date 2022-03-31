<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Prospect;
use App\Models\ProsDetails;
use App\Models\ProsBlackListed;
use App\Models\Location;
use App\Models\Contact;
use App\Models\Searchlist;

class Search extends Model
{

  /* jos ei ole vielä registöröity
    *
    *
   */
    use HasFactory;
    protected $guared = [];

    public function perName($name)
    {
      if($response = Http::get('http://api.mikromike.fi/api/SearchByName/'.$name)){
        $results = (new SELF())->statusData($response);
      }
   }
    public function perVatID($vatId)
    {
      // if($response = Http::get('http://ProsCore-api.test/SearchVatID/'.$vatId)){
         if($response = Http::get('http://api.mikromike.fi/api/SearchVatID/'.$vatId)){

          $results = (new SELF())->statusData($response);
          return $results;
        }
    }
    public function perDates($from, $to)
    {
      if($response = Http::get('http://api.mikromike.fi/api/SearchByDates/'.$from .'/' .$to)){
          $results = (new SELF())->statusData($response);
      }
    }
    public function perPostalCode($code)
    {
      // dump($code);
  //    if($response = Http::get('http://ProsCore-api.test/SearchPostalCode/'.$code))   // Test Env. locally!
    if($response = Http::get('http://api.mikromike.fi/api/SearchByPostalCode/'.$code)){
          $results = (new SELF())->statusData($response);
      }
    }
    //  'totalResults=true&maxResults=1000&resultsFrom=0&streetAddressPostCode=01300&companyForm=OY'
    public function extractJson($data)
    { // single data

      $status = '';
      $message = '';
      $vatId = '';
      $businessLines = array();
      $results =  Arr::exists($data, 'results');
      $liq =  Arr::exists($data, 'liquidations');
      $aux =  Arr::exists($data, 'auxiliaryNames');
      $changes =  Arr::exists($data, 'businessIdChanges');
      $registers =  Arr::exists($data, 'registeredEntries');



      $data = $data['results'][0];

      if ($results == 'true'){
               if($liq){
                  (new ProsBlackListed())->liquidations($data);
               } else {
                   $company['name'] = $data['name'];
                   $company['vatId'] = $data['businessId'];
                   $uri = $data['detailsUri'];
                   $company['registrationDate'] = $data['registrationDate'];

                   if (empty($uri)){
                     $uri === 'not availble';
                   }else {

                 }
        if ($registers == 'true'){
               $prosModel = (new Prospect())->emptyCompanyName($company, $uri, $businessChanges);
             }else {
               $businessChanges = null;
               $prosModel = (new Prospect())->emptyCompanyName($company, $uri, $businessChanges );
             }
               foreach ($prosModel as $pros)
               {
                  $results =  Arr::exists($pros, 'prospect');

                  if ($results)
                  {
                    $propectId = $pros['prospect']['id'];

                  // end of IF
                  }
               }
               //else {                 }


              // dd($results);
/*
                if($prosModel){
                  $prosCreated  = $prosModel->toArray();
                    if( array_key_exists('id', $prosCreated))
                    {
                      $propectId = $prosCreated['id'];
                        if($prosCreated['id'] == 'failed'){
                          dump('company blacklisted!');
                      }else{
                        dump($prosCreated['id']);
                      }
                    }else {
                      dd(  $prosCreated);
                    } */



              //  }

          //      $prosModel = (new Prospect())->emptyCompanyName($company, $uri);
            //    dd($prosModel);


              if(is_array($data['businessLines'])){
                $businessLines = $data['businessLines'];
                $bssModel = (new ProsBssLine())->saveBss($businessLines);

                if(!empty($bssModel && $pros['prospect'])){
                    $isok = $pros['prospect']->bssCodeField()->attach($bssModel->id);
                }
                  //    $isok = $prosCreated->bssCodeField()->attach($bssModel->id);
                      }else{
                        // empty busines field code!
                        $bssLineEN = array();
                        $bssLineFI = array();
                        $bssLineSE = array();

                        $bssLineEN = array(
                          'code' => '9999999',
                          'name' => 'Unknown Business Field name'
                        );
                        $bssLineFI = array(
                          'code' => '9999999',
                          'name' => 'Toimialaa ei ole ilmoitettu'
                        );
                        $bssLineSE = array(
                          'code' => '9999999',
                          'name' => 'Unknown Business Field name'
                        );
                        $prosline = array($bssLineEN, $bssLineFI,$bssLineSE);
                      (new ProsBssLine())->saveEmptyBss($prosline);
                      }
                      //  if(is_array($data['addresses'])){
                       if(!empty($data['addresses'])){

                      $location = (new Location())->extractLocation($data, $propectId);
                     }

                    if(!empty($data['contactDetails'])){
                      $contacts = $data['contactDetails'];
                       $vatId = $data['businessId'];

                       (new Contact())->extractContact($contacts, $vatId );
                    }
                 };    /// end of Else
              return 'true';
        } // end of results
    return 'false';
  }    // end of function

    public function counter($r)
    {
      $sum = $r->count();
      return $sum;
    }
    public function statusData($response)
    {
     $statusMsg = $response->json('Status_message');
      // Get status code from Response.
      $resCode = $response->json('Status');

      if($resCode === 200){
          $response = $response->json('Response');
          $r = collect($response['results']);
        $sum = (new SELF())->counter($r);
        if($sum === 1)
        {
            $data = $response;
            (new SELF())->extractJson($data); // single data
          return $results = array(
            'Status' => $resCode,
            'Status_message' => $statusMsg,
            'Response' => $response
          );
        }else
        { // list mode, more than one company
          (new SELF())->listSearch($response);
        }
      } else {   /// http error code other than 200
         $resCode = $response->json('Status');
         $statusMsg = $response->json('Status_message');
         $response = '';
         return $results = array(
           'Status' => $resCode,
           'Status_message' => $statusMsg,
           'Response' => $response
         );
       }
   } // End of public function statusData
   public function packCompany ($pros)
   {
     $company['name'] = $pros['name'];
     $company['vatId'] = $pros['businessId'];
     $company['registrationDate'] = $pros['registrationDate'];
     $uri = $pros['detailsUri'];
      return $response = array(
        $company,
        $uri
      );
   }
   public function listSearch($response)
   {
     foreach ($response['results'] as $key => $pros){
       $vatId = $pros['businessId'];
       $name = $pros['name'];
       $regDate = $pros['registrationDate'];
       (new SELF())->perVatID($vatId);
       (new Searchlist())->saveList($vatId, $name, $regDate);

     }
   }
}  // End of Class
