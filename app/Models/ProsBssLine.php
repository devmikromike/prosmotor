<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class ProsBssLine extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pros_bss_lines';

    public function pros()
    {
      return $this->belongTo(Prospect::class);
    }

    public function codeList($idsCodes)
    {  // Business line codes
      $results = [];

        foreach ($idsCodes as $id)
        {
          $data  = (new SELF())->bss( $id)->get();
          $name = $data[0]['nameFI'];
          $code = $data[0]['code'];
          $field['nameFI'] = $name;
          $field['code'] = $code;
          $results[] = $field;
        }
      return $results;
    }
    public function scopeCodeAll($query)
    {
      return $query
      ->orderBy('nameFI')
      ->get();
    }

    public function scopeBss($query, $id)
    {
      return $query ->where('id','=', $id);
    }
    public function scopeBssCodes($query, $codes)
    {
      return $query ->where('name','=', $city);
    }

    public function findCode($prospect_id)
    {
  //    pros()
    }

    public function saveEmptyBss($prosline)
    {

      $bssLineEN = array();
      if($prosline[0])
      {
      // English
      $bssLineEN['code']  = $prosline[0]['code'];
      $bssLineEN['name' ] = $prosline[0]['name'];
      (new SELF())->saveBssEN($bssLineEN);
     }

      // Finnish
      $bssLineFI = array();
      if($prosline[1])
      {
      $bssLineFI['code']  = $prosline[1]['code'];
      $bssLineFI['name' ] = $prosline[1]['name'];
      (new SELF())->saveBssFI($bssLineFI);
     }
      // Swedish
      $bssLineSE = array();
      if($prosline[2])
      {
      $bssLineSE['code']  = $prosline[2]['code'];
      $bssLineSE['name' ] = $prosline[2]['name'];
      (new SELF())->saveBssSE($bssLineSE);
     }

    }
    public function saveBss($businessLines)
    {
      $bss = '';

        foreach ($businessLines as $key => $value) {
          $code = $value['code'];
          if($key == 1)
          {
            $bssLineFI = $value['name'];
          $bss  =  (new SELF())->saveBssFI($bssLineFI, $code);
          }
          if($key == 2)
          {
            $bssLineSE = $value['name'];
            (new SELF())->saveBssSE($bssLineSE, $code);
          }
          if($key == 0)
          {
            $bssLineEN = $value['name'];

            (new SELF())->saveBssEN($bssLineEN, $code);
          }
        }

      //   dd($bss);
       return $bss;
    }
      public function saveBssEN($bssLineEN, $code)
      {


          // $name = $bssLineEN;

          $c = (new SELF())->updateOrCreate([
            'code' => $code,
          ] ,[
            'nameEN' => $bssLineEN
          ]);
      }
      public function saveBssSE($bssLineSE, $code)
      {
            $name = $bssLineSE;

            $c = (new SELF())->updateOrCreate([
              'code' => $code,
            ] ,[
              'nameSE' => $name
            ]);
      }
      public function saveBssFI($bssLineFI, $code)
      {
        $name = $bssLineFI ;

         $c = (new SELF())->updateOrCreate([
           'code' => $code,
         ] ,[
           'nameFI' => $name
         ]);

         return $c;
      }
}
