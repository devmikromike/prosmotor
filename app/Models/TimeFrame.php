<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use DB;
use App\Models\Search;
use App\Jobs\SearchListJob;
use App\Listeners\TimeFrameBatch;


class TimeFrame extends Model
{
    use HasFactory;
    protected $table = 'time_frames';
    protected $guarded = [];

    public $startRangeDate;  // Api format
    public $endRangeDate;   // Api format
    public $newStartDate;
    public $newEndDate;
    public $startDate;   // Carbon format
    public $endDate;     // Carbon format
    public $datesLeft;
    public $divided;
    public $diffent;  // Carbon format
    public $offset;
    public $rangeDates = 5;
    public $process = array();
    public $status;
    public $freshStartDate;
    public $carbonStartDate;
    public $carbonEndDate;
    public $carbonFinalEndDate;
    public $carbonNewEndDate;
    public $firstId;
    public $lastId;
    public $rowId;


    public function rowId($value)
    {   Log::notice('step 21: returning scopeRowId from model');

      $status = DB::table('time_frames')->where('status', $value)
                    ->pluck('id');
        foreach($status as $s)
        {
            return $s;
        }

    }
    public function retRow($id, $batch)
      {
        Log::notice('step 23: search startDate');
        $startDate = DB::table('time_frames')->where('id', $id)
                      ->pluck('start_date');
        Log::notice('step 24: search endDate');
        $endDate = DB::table('time_frames')->where('id', $id)
                    ->pluck('end_date');
        Log::notice(': search status');
        $statusFields = DB::table('time_frames')->where('id', $id)
                   ->pluck('status');

        foreach($startDate as $date)
        {
          $this->startDate = $date;
        }
        foreach($endDate as $date)
        {
          $this->endDate = $date;
        }
        foreach($statusFields as $status)
        {
          $this->status = $status;
        }

          $batch->add(new SearchListJob($this->startDate, $this->endDate));
          $this->status = "Search in process";

          (new SELF())->saveStatus($id, $this->status);

          return 'Done';
    }
    public function saveStatus($id, $status)
    {
      $sta =  $this->find($id)
       ->updateOrFail([
          'status' => $status
     ]);
     Log::notice('step 26: updated status to : '.$status);
    }
    public function betweenDates($startRangeDate, $endRangeDate)
    { //output carbon object:  date: 2022-03-21 00:00:00.0 UTC (+00:00)

        $this->startRangeDate = $startRangeDate;
        $this->freshStartDate = Carbon::parse($startRangeDate);
        $this->carbonStartDate = Carbon::parse($startRangeDate);
        $this->carbonFinalEndDate =  Carbon::parse($endRangeDate);
        $this->carbonEndDate =  Carbon::parse($endRangeDate);     //output carbon object
        $this->diffent = $this->freshStartDate->diffInDays($this->carbonFinalEndDate);  // Carbon::diffInDays -> int()
          Log::info(' step 8: Init in TimeFrame-model ');
        $this->firstProcess();
    }
    public function firstProcess()
    {
      $lastId = 0;
        Log::info(' step 9: start firstProcess in TimeFrame-model ');
      if($this->diffent > $this->rangeDates){
        $this->status = "Start Setup";
        $this->carbonEndDate = $this->carbonStartDate->addDays((int)$this->rangeDates);
        $this->newEndDate = $this->carbonToApiFormat($this->carbonEndDate);
        $this->newStartDate   = $this->carbonToApiFormat($this->freshStartDate);
          $this->saveDates();
      }else{
          if($this->diffent < $this->rangeDates){
             $this->newEndDate = $this->carbonToApiFormat($this->carbonEndDate);
             $this->newStartDate   = $this->carbonToApiFormat($this->freshStartDate);
               $this->status = 'Final dates';
               $this->saveDates();
          }
      }
      // dd($this->carbonStartDate,   $this->carbonEndDate);
    }
    public function saveStartDate()
    {
        Log::info(' step 12: save StartDate  in TimeFrame-model ');
        $timeTable = $this->create([
          'start_date' => $this->newStartDate,
          'status' => $this->status
       ]);
        $this->lastId = $timeTable->id;
          $this->newEndDate();
         return $timeTable->id;
    }
    public function saveDates()
    {
      Log::info(' step 10: saveDates in TimeFrame-model ');
       $timeTable = $this->create([
         'start_date' => $this->newStartDate,
         'end_date' => $this->newEndDate,
         'status' => $this->status
      ]);
      $this->lastId = $timeTable->id;
      if($this->diffent > $this->rangeDates){
          $this->newStartDate();
      }
    }
        public function saveEndDate()
    {
        Log::info(' step 14: save EndDate in TimeFrame-model ');
       $timeTable =  $this->find( $this->lastId)
        ->updateOrFail([
           'end_date' => $this->newEndDate,
           'status' => $this->status
      ]);
     $this->newStartDate();
    }
// get's date in Carbon format(object)
    public function newStartDate()
    {  // timestamp(Carbon format) with date & time  & timezone format!
          $diffDays = $this->carbonFinalEndDate->diffInDays($this->carbonStartDate);
          Log::info(' step 11: create newStartDate  in TimeFrame-model ');
         if($diffDays > 0){
              $this->carbonStartDate = $this->carbonEndDate->addDays(1);
              $this->newStartDate = $this->carbonToApiFormat($this->carbonStartDate);
              $this->status = 'Saving start date';
              $this->saveStartDate();
        return $this->newStartDate;
      }
      Log::info(' step 11: create newStartDate  in TimeFrame-model Finial round');
    //  return;   ////????
    }
// get's date in Carbon format(object), return Carbon format
    public function newEndDate()
    {
       // timestamp(Carbon format) with date & time  & timezone format!
    $diffDays = $this->carbonFinalEndDate->diffInDays($this->carbonEndDate);
    Log::info(' step 13: create newEndDate in TimeFrame-model ');
        if($diffDays > (int)$this->rangeDates)
        {
            if($this->carbonStartDate < $this->carbonFinalEndDate){
                $this->carbonEndDate = $this->carbonStartDate->addDays((int)$this->rangeDates);
                  $this->newEndDate = $this->carbonToApiFormat($this->carbonEndDate);
                  $this->status = 'save end dates';
                     $this->saveEndDate();
           }
       } else {
           if( $diffDays < (int)$this->rangeDates){
      //        dump(  'Final dates'.$diffDays);
                $this->carbonEndDate = $this->carbonStartDate->addDays((int)$diffDays);
                $this->newEndDate = $this->carbonToApiFormat($this->carbonEndDate);
                $this->status = 'Final dates';
                $this->saveEndDate();
           }
       }
    }
    public function carbonToApiFormat($date)
    {
     $apiDate = $date->format('Y-m-d');
     return $apiDate;
    }
    //  Api format to Carbon (object).
    public function apiFormatToCarbon($date)
    {
    $carbonDate = Carbon::parse($date);
    return $carbonDate;
    }
}
