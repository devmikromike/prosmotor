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
use App\Models\BatchProcessing;
use App\Jobs\TimeFrameJob;
use App\Jobs\SearchListJob;
use App\Jobs\ApiBridgeJob;
use App\Jobs\ExtractJsonDataJob;
use App\Events\ExtractTimeFrameEvent;
use App\Events\TimeFrameFinalEvent;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class Search extends Model
{
    use Batchable, HasFactory;
    protected $guared = [];

    public $statusMsg, $resCode;
    public $batchName;
    public $vatId;
    public $counter = 1;
    public $lastRowId;
    public $lastRow;
/*  Four API Call to Api Bridge. */
    public function perName($name)
    {
        Log::info(' 33: Send request to API Bridge per Vatid: '.$name);
        if($response = Http::get('http://api.mikromike.fi/api/SearchByName/'.$name)){
           Log::info(' 34: get response from API Bridge'.$name);

                     if($results =  (new SELF())->checkStatus($response))
                     {
                        Log::info(' true; checkStatus for '.$name.' - '.$results);
                       return $results;
                     }

                        Log::info(' false; checkStatus for '.$name.' - '.$response->json());
                     return $response->json();   /// Array or Object (JSON)
                   }
                   Log::error('false for response: '.$name);
                return $name;
   }
    public function perVatID($vatId)
    {
        Log::info(' 33: Send request to API Bridge per Vatid: '.$vatId);
      // if($response = Http::get('http://ProsCore-api.test/SearchVatID/'.$vatId)){
         if($response = Http::get('http://api.mikromike.fi/api/SearchVatID/'.$vatId)){
             Log::info(' 34: get response from API Bridge: '.$vatId);
             (new SELF())->resPerVatId($response, $vatId);
          return 1;
        }
      return 0;
    }
    public function perDates($from, $to)
    {
      $seconds = number_format((microtime(true) - $this->startTime) * 1000, 2);  //WIP - check it! //
        Log::info('step 27: Send request to API Bridge: '.$from.' : '.$to);
          if($response = Http::get('http://api.mikromike.fi/api/SearchByDates/'.$from .'/' .$to)){
        Log::info('step 28: get response from API Bridge'.$from.' : '.$to);
          $res =  (new SELF())->resPerDates($response);
        return 1;
      }
      return 0;
    }
    public function perPostalCode($code)
    {
  //    if($response = Http::get('http://ProsCore-api.test/SearchPostalCode/'.$code))   // Test Env. locally!
      if($response = Http::get('http://api.mikromike.fi/api/SearchByPostalCode/'.$code)){
          $results = (new SELF())->statusData($response);
      }
    }
    public function perPostalCodeWithBssCode($code, $bssCode)
    {
      // ?totalResults=true&maxResults=1000&streetAddressPostCode=00100&businessLineCode=70220&companyRegistrationTo=2014-01-01
      //    if($response = Http::get('http://ProsCore-api.test/SearchPostalCode/'.$code))   // Test Env. locally!
        Log::info('step 27: Send request to API Bridge: '.$code.' : '.$bssCode);
      if($response = Http::get('http://api.mikromike.fi/api/SearchByPostalCode/'.$code.'/'.$bssCode)){
          Log::info('step 28: get response from API Bridge to perPostalCodeWithBssCode!' );
          $results = (new SELF())->resPostalCodeWithBssCode($response);
          return 1;
        }
        return 0;
    }
    public function resPostalCodeWithBssCode($response)
    {
      if($results =  (new SELF())->checkStatus($response))
      {
    //     Log::info(' true; checkStatus for '.$vatId.' - '.$results);
        return $results;
      }
    }
    public function resPerVatId($response, $vatId)
    {
      if($results =  (new SELF())->checkStatus($response))
      {
    //     Log::info(' true; checkStatus for '.$vatId.' - '.$results);
        return $results;
      }
  //       Log::info(' false; checkStatus for '.$vatId.'- '.$response);
      return $response;   /// Array ???
    }
    public function resPerDates($response)
    {
        $res =  (new SELF())->checkStatus($response);
        $search = new Search;
          event(new TimeFrameFinalEvent($search));
      return 1;
    }


    public function nextRow()
    {
        $rowId = (new LastRow())->findLastRowId();
        $status = (new TimeFrame())->retStatus($rowId);
        $last = (new TimeFrame())->rowId('Final');
        if($last > $rowId)
        {
            $newId = (new LastRow())->GoNextRow($rowId);
            $name = ('NextJob-'.$newId);
            $batch = (new BatchProcessing())->createBatch($name);
             (new TimeFrame())->retRow($newId, $batch);
          return 1;
        }else{
          if($status == 'Final')
          {
              $name = ('NextJob-'.$rowId);
              $batch = (new BatchProcessing())->createBatch($name);
              (new TimeFrame())->retRow($rowId, $batch);
              $newId = 'No More';
            return 1;
          }
        }
        return 1;
    }

     public function checkStatus($response)
     {
        Log::info('Checking response status...');

            $results = (new SELF())->statusData($response);
            $data = (new SELF())->dataResultExtraction($results);
          if($data)
          {
            $resp = (new SELF())->dataExtraction($results);
            $sum = (new SELF())->summaer($resp);
            $res = (new SELF())->singleOrList($sum, $resp);
              Log::info('Response status COMPLETED...');
         return $res;
       }else
       {
         return $res ='';
       }
     }
     public function dataExtraction($results)
     {

       $response = $results['Response']['Response'];
       return $response;
     }
     public function dataResultExtraction($results)
     {
       if($response = $results['Response'])
       {
          return $response;
       }
       return $response = '';
     }
     public function summaer($response)
     {
       // Data level
       $r = collect($response['results']);
       $sum = (new SELF())->counter($r);
    //   Log::info('Checking response Sum...');
       return $sum;
     }
    public function singleOrList($sum, $response)
    {
      if($sum === 1)
      {
      //   Log::info('Response Sum: '.$sum);
      //   $data = $response['results'][0];
          $data = $response;
          if(is_array($data))
          {
            $results =  Arr::exists($data, 'results');
            $id = $response['results'][0]['businessId'];
            Log::info('extractDataJob'.' - '.$id);
            $name = ('extractData'.'-'.$id);

            if ($results == 'true'){
              $batch = Bus::batch([
                  // ...
                  new ExtractJsonDataJob($data)
              ])->then(function (Batch $batch) {
                  // All jobs completed successfully...
              })
              ->onQueue('extractJson')
              ->name($name)
              ->dispatch();
              /*
                $JsonDataJob = ExtractJsonDataJob::dispatch($data)
                ->onQueue('ExtractJson'); */ // toimii

          /*    $batch = (new BatchProcessing())->createBatch($name);
                $batch->add(new ExtractJsonDataJob($data));   */   /// failed, batch cannot get array!
            return 1;
            }
          }
        return 0;

      }else {
         Log::info('Response Sum: '.$sum);
         Log::info('step 30: List mode detected');
         Log::info('*********************************************');
         $data = $response['results'];

           (new SELF())->listSearch($data);
        //    Log::info(' List mode created and closed.');
         return;
      }
   }
    public function extractJson($data)
    { // single data
        //  liq status: 2593915-3

    Log::info('step 32: Black sack extraction process: [STARTED] ');
        $status = '';
        $message = '';
        $vatId = '';
        $businessLines = array();
        $results =  Arr::exists($data, 'results');
          // $data = $data['results'][0];
        $liq =  Arr::exists($data, 'liquidations');
          //   $aux =  Arr::exists($data, 'auxiliaryNames');
      //     $changes =  Arr::exists($data, 'businessIdChanges');
      //     $registers =  Arr::exists($data, 'registeredEntries');

      //  $data = $data['results'][0];

        if ($results == 'true'){

          $data = $data['results'][0];

      //      $liq =  Arr::exists($data, 'liquidations');
            $aux =  Arr::exists($data, 'auxiliaryNames');
            $changes =  Arr::exists($data, 'businessIdChanges');
            $registers =  Arr::exists($data, 'registeredEntries');
               if($liq){

                 Log::error('BlackList: [STARTED] '.$data['businessId']);
                  (new ProsBlackListed())->liquidations($data);
                  return 1;
               } else {
                   $company['name'] = $data['name'];
                   $company['vatId'] = $data['businessId'];
                   $uri = $data['detailsUri'];
                   $company['registrationDate'] = $data['registrationDate'];
                     Log::info('Extract: [STARTED] '.$data['businessId']);
                   if (empty($uri)){
                     $uri === 'not availble';
                   }else {}
          if ($registers == 'true'){
              if($changes)
              {
                $businessChanges = $data['businessIdChanges'];
                 $prosModel = (new Prospect())->emptyCompanyName($company, $uri, $businessChanges);
              }

               }else {
                 //Log::info('step 33: Black sack extraction process: [CompanyName Check]');
                 $businessChanges = null;
                  Log::info('Extract businessChanges: [STARTED] '.$data['businessId']);
                 $prosModel = (new Prospect())->emptyCompanyName($company, $uri, $businessChanges );
               }

               foreach ($prosModel as $pros)
               {
                  $results =  Arr::exists($pros, 'prospect');

                  if ($results)
                  {
                    $propectId = $pros['prospect']['id'];   // VatId = BusinessId
                  // end of IF
                  }
               }
              if(is_array($data['businessLines'])){
                $businessLines = $data['businessLines'];
                     //Log::info('step 36: Black sack process: [BusinessLine  Created]');
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

                       //Log::info('step 37: Black sack process: [Extract Contacts]');
                       (new Contact())->extractContact($contacts, $vatId );
                    }
                     Log::info('Extract: [COMPLETED] '.$data['businessId']);
                 };    /// end of Else
                 Log::info('[DONE] '.$data['businessId']);
              return 'true';
        } // end of results
    return 'false';
  }    // end of function
/*  Extract incoming Json data END.  */
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
          Log::info('step 29:  response status: [OK]');

          return $results = array(
            'Status' => $resCode,
            'Status_message' => $statusMsg,
            'Response' => $response
          );
        } else {
                if($resCode === 404){
                  Log::info('*************');
                  Log::info('response status: [ERROR]');
                  Log::error('Error with response status: '.$resCode);
                  Log::info('*************');

                  return $results = array(
                    'Status' => $resCode,
                    'Status_message' => $statusMsg,
                    'Response' => $response
                  );
                }
                if($resCode === 422){
                  Log::info('*************');
                  Log::info('response status: [ERROR]');
                  Log::error('Error with response status: '.$resCode);
                  Log::info('*************');

                  return $results = array(
                    'Status' => $resCode,
                    'Status_message' => $statusMsg,
                    'Response' => $response
                  );
                }
                if($resCode === 500){
                  Log::info('*************');
                  Log::info('response status: [ERROR]');
                  Log::error('Error with response status: '.$resCode);
                  Log::info('*************');

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
                   Log::error('step 31 HTTP STATUS ERROR: '.$error);
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
    // public function listSearch($response, $id)
   public function listSearch($data)
   {
       $counter = $this->counter;

       foreach ($data as $key => $pros){
          if($counter < 150 )   {
              //Log::info('Results:  '.$sum. ' in queue.');
              $counter++;
          }else {
            $counter = 1;
             sleep(100);
            $this->counter = $counter;
            Log::info('Counter Reseted: '.$this->counter);
         }
         Log::info('listSearch out of if: ');
         $this->vatId = $pros['businessId'];
         $name = $pros['name'];
         $regDate = $pros['registrationDate'];

         Log::info('step 31: Handeling VatId: '.$this->vatId.' with is number: '.$counter );

           if (!empty($name))
             {
               $startTime = microtime(true);
                $batch = (new BatchProcessing())->createBatchJob($this->vatId);
               $seconds = number_format((microtime(true) - $startTime) * 1000, 2);  //WIP - check it! //
                  Log::info('ApiBridgeJob completed at:  ' .$seconds . '  millseconds');
                (new Searchlist())->saveList($this->vatId, $name, $regDate);
             }else {
               Log::error('step 34: No Company name on PRH Record for Vatid. '.$this->vatId).' Company blacklisted!.';
               $reason = 'No Company name on PRH Record for Vatid.';
               $errors = (new ProsBlackListed())->blacklisted($this->vatId, $reason);
             }
     } // End of ForEach
     Log::info('**************************');
       Log::info('list search process done. ');
       Log::info('**************************');
     return 1;
   }
}  // End of Class
