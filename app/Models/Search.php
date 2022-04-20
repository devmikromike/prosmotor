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
use App\Models\TimeFrame;
use App\Jobs\TimeFrameJob;
use App\Jobs\Step2job;
use App\Events\ExtractTimeFrameEvent;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Log;

use Throwable;

class Search extends Model
{
  /* jos ei ole vielä registöröity
    *
    *
   */
    use HasFactory;
    protected $guared = [];
    public $statusMsg, $resCode;

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
      Log::info('step 27: Send request to API Bridge');
      if($response = Http::get('http://api.mikromike.fi/api/SearchByDates/'.$from .'/' .$to)){
      Log::info('step 28: get response from API Bridge');
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
    public function createBatchJobByVatID($vatId)
    {

    }
    public function createBatchJobBySearchList()
    {

    }
    public function createTimeFrameBatchJob($from, $to)
    {
      Log::info('Step 2 : Create TimeFrameBatchJob from model-Search');
    $batchId = (new SELF())->runBatchTimeFrame($from, $to );
    Log::info('Step: 6 return TimeFrameBatchJob - main process Done');
    return ($batchId);
    }
    public function runBatchTimeFrame($from, $to)
    {
      Log::info('Step 3: Create Batch');
      $batch = Bus::batch([])
        ->name('ExtractTimeFrameJob')
        ->dispatch();
        Log::info('Step 4: Add Job to Batch');
      $batch->add(new TimeFrameJob($from, $to));

    /*    Log::info('Step: 5 call ExtractTimeFrameEvent');
      $timeFrame = new TimeFrame;
           event(new ExtractTimeFrameEvent($timeFrame));
             Log::info('Step: 14 return batch info'); */
     Log::info('Step: 5 return batch info');
      return $batch->id;
    }
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
              if(is_array($data['businessLines'])){
                $businessLines = $data['businessLines'];
                $bssModel = (new ProsBssLine())->saveBss($businessLines);

              //  dd($bssModel);

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
      //  $res = $response->json('Response');

     $statusMsg = $response->json('Status_message');
      // Get status code from Response.
      $resCode = $response->json('Status');

      Log::info('step 29: checking response status: '.$resCode);

      if($resCode === 200){
        Log::info('step 29:  response status: [OK]');

          $response = $response->json('Response');
          $r = collect($response['results']);
        $sum = (new SELF())->counter($r);
        if($sum === 1)
        {
            $dataId = $response['results'][0];

          //  dd($dataId);

            $data = $response;
            $id = $dataId['businessId'];
            Log::info('step 30: handeling single data: '.$id);
            (new SELF())->extractJson($data); // single data
          return $results = array(
            'Status' => $resCode,
            'Status_message' => $statusMsg,
            'Response' => $response
          );
        }else
        { // list mode, more than one company
            Log::info('step 31: List mode detected');
          (new SELF())->listSearch($response);
        }
      } else {
          if($resCode === 404){
            return $results = array(
              'Status' => $resCode,
              'Status_message' => $statusMsg,
              'Response' => $response
            );
          }
          /// http error code other than 200
         $resCode = $response->json('Status');
         $statusMsg = $response->json('Status_message');
         $errors =  Arr::exists($response, 'Errors');
         $response = '';
         if($errors){
           foreach ($errors as $error)
           {
             Log::error('step 31: '.$error);
           }
         }
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
         Log::info('step 31: Handeling VatId: '.$vatId);

         if (!empty($name))
           {
               Log::info('step 32: Sending '.$vatId.' to API Bridge');
             (new SELF())->perVatID($vatId);
             Log::info('step 32: Saving '.$vatId.' to locally: Searchlist-table');
             (new Searchlist())->saveList($vatId, $name, $regDate);

           }else {
               Log::error('step 33: No Company name on PRH Record for Vatid. '.$vatId).' Company blacklisted!.';
             $reason = 'No Company name on PRH Record for Vatid.';
             $errors = (new ProsBlackListed())->blacklisted($vatId, $reason);
           }

     }
   }
}  // End of Class
