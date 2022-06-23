<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class Register extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prospects()
    {
      return $this->belongsToMany(Prospect::class);
    }

    public function extractRegisters($registers, $prosModel)
    {
      foreach ($registers as $key => $register) {
         if($register['language'] ==='EN')
         {

           $authority =  (int) $register['authority'];
           $reg =  (int) $register['register'];
           $status =  (int) $register['status'];
           $description =   $register['description'];
           $regDate =  $register['registrationDate'];
           $endDate =  $register['endDate'];
           $statusDate =  $register['statusDate'];

             $save['authority'] = $authority;
             $save['register'] = $reg;
             $save['status'] = $status;
             $save['description'] = $description;
             $save['statusDate'] = $statusDate;
             $save['regDate'] = $regDate;
             $save['endDate'] = $endDate;

          $savedRegisters = SELF::store($save);

          if(!empty($savedRegisters && $prosModel)){
              $isok = $prosModel->registers()->attach($savedRegisters->id);
          }

        //  $auth = SELF::authority($authority);
        //  $retRegister = SELF::findRegister($reg);
        //  $retStatus = SELF::findRegister($status);
           dd('huhuu');
         }
      }
    }
    public function store($save)
    {
      $registers = (new SELF())->updateOrCreate($save);
      return $registers;

    }
    public function findAuthority($authority)
    {  // source for register

      switch($authority){
        case('1');
            return 'TaxOffice';
          break;
        case('2');
          return 'PRH';
        break;
      }
    }
    public function findRegister($reg)
    {  // source for register

      switch($reg){
        case('1');
            return 'PRH';
          break;
        case('2');
          return 'Foundation';
        break;
        /*
        case('3');
          return 'väestörekisteriä';
        break;   */
      }
    }
    public function findStatus($status)
    {  // source for register

      switch($status){
        case('0');
            return 'Common';
          break;
        case('1');
          return 'Unregistered';
        break;

        case('2');
          return 'Registed';
        break;
      }
    }
}
