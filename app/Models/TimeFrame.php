<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeFrame extends Model
{
    use HasFactory;

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
    public $lastId;

    public function betweenDates($startRangeDate, $endRangeDate)
    { //output carbon object:  date: 2022-03-21 00:00:00.0 UTC (+00:00)
        $this->startRangeDate = $startRangeDate;
        $this->freshStartDate = Carbon::parse($startRangeDate);
        $this->carbonStartDate = Carbon::parse($startRangeDate);
        $this->carbonFinalEndDate =  Carbon::parse($endRangeDate);     //output carbon object
        $this->diffent = $this->freshStartDate->diffInDays($this->carbonFinalEndDate);  // Carbon::diffInDays -> int()
        $this->firstProcess();
    }
    public function firstProcess()
    {
      $lastId = 0;
      $this->status = "Start Setup";
      $this->carbonEndDate = $this->carbonStartDate->addDays((int)$this->rangeDates);
        $this->newEndDate = $this->carbonToApiFormat($this->carbonEndDate);
        $this->newStartDate   = $this->carbonToApiFormat($this->freshStartDate);
          $this->saveDates();
    }
    public function saveStartDate()
    {
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
       $timeTable = $this->create([
         'start_date' => $this->newStartDate,
         'end_date' => $this->newEndDate,
         'status' => $this->status
      ]);
      $this->lastId = $timeTable->id;
        $this->newStartDate();
    }
        public function saveEndDate()
    {
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

         if($diffDays > 0){
              $this->carbonStartDate = $this->carbonEndDate->addDays(1);
              $this->newStartDate = $this->carbonToApiFormat($this->carbonStartDate);
              $this->status = 'Saving start date';
              $this->saveStartDate();
        return $this->newStartDate;
      }
    }
// get's date in Carbon format(object), return Carbon format
    public function newEndDate()
    {
       // timestamp(Carbon format) with date & time  & timezone format!
    $diffDays = $this->carbonFinalEndDate->diffInDays($this->carbonEndDate);
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
