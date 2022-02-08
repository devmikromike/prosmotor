<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class ProsBssLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pros()
    {
      return $this->belongTo(Prospect::class, 'bssCode');
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
        $bssLineEN = array();
        foreach ($businessLines as $key => $value) {

          if($key == 0)
          {
            $bssLineEN = $value;
          $code =(new SELF())->saveBssEN($bssLineEN);
          }
          if($key == 1)
          {
            $bssLineFI = $value;
            (new SELF())->saveBssFI($bssLineFI);
          }
          if($key == 2)
          {
            $bssLineSE = $value;
            (new SELF())->saveBssSE($bssLineSE);
          }
        }
        return $code;
    }
      public function saveBssEN($bssLineEN)
      {
          $code = $bssLineEN['code'];
          $name = $bssLineEN['name'];

          $c = (new SELF())->firstOrCreate([
            'code' => $code,
          ] ,[
            'nameEN' => $name
          ]);

          return $code;
      }
      public function saveBssSE($bssLineSE)
      {
           $code = $bssLineSE['code'];
            $name = $bssLineSE['name'];

            $c = (new SELF())->updateOrCreate([
              'code' => $code,
            ] ,[
              'nameSE' => $name
            ]);
      }
      public function saveBssFI($bssLineFI)
      {
        $code = $bssLineFI['code'];
        $name = $bssLineFI['name'];

         $c = (new SELF())->updateOrCreate([
           'code' => $code,
         ] ,[
           'nameFI' => $name
         ]);
      }
}
