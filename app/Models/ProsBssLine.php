<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsBssLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function codeList($idsCodes)
    {  // Business line codes
      $results = [];

        foreach ($idsCodes as $id)
        {
          $data  = SELF::bss( $id)->get();
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
    public function saveBss($businessLines)
    {
        $bssLineEN = array();
        foreach ($businessLines as $key => $value) {

          if($key == 0)
          {
            $bssLineEN = $value;
          $code =  SELF::saveBssEN($bssLineEN);
          }
          if($key == 1)
          {
            $bssLineFI = $value;
            SELF::saveBssFI($bssLineFI);
          }
          if($key == 2)
          {
            $bssLineSE = $value;
            SELF::saveBssSE($bssLineSE);
          }
        }
        return $code;
    }
      public function saveBssEN($bssLineEN)
      {
          $code = $bssLineEN['code'];
          $name = $bssLineEN['name'];

          $c = SELF::firstOrCreate([
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

            $c = SELF::updateOrCreate([
              'code' => $code,
            ] ,[
              'nameSE' => $name
            ]);
      }
      public function saveBssFI($bssLineFI)
      {
        $code = $bssLineFI['code'];
        $name = $bssLineFI['name'];

         $c = SELF::updateOrCreate([
           'code' => $code,
         ] ,[
           'nameFI' => $name
         ]);
      }
}
