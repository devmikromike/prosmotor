<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsBssLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function codeList($codes)
    {
      $sum = $codes->count();

   

        foreach ($codes as $code)
        {

        }
        return $code;

    }
    public function scopeCodeAll($query)
    {
      return $query ->get()->toArray();
    }

    public function scopeBss($query, $code)
    {
      return $query ->where('nameFI','=', $code);
    }
    public function scopeBssCodes($query, $codes)
    {
      return $query ->where('name','=', $city);
    }

    public function saveBss($businessLines)
    {
        $bssLineEN = array();
        foreach ($businessLines as $key => $value) {
          // dump($key, $value);

          if($key == 0)
          {
            $bssLineEN = $value;
  //          dump ("Save businessLines data EN. "  );
          $code =  SELF::saveBssEN($bssLineEN);
          }
          if($key == 1)
          {
            $bssLineFI = $value;
  //          dump ("Save businessLines data FI. "  );
            SELF::saveBssFI($bssLineFI);
          }
          if($key == 2)
          {
            $bssLineSE = $value;
    //        dump ("Save businessLines data SE. "  );
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
