<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Search;
use App\Models\TimeFrame;
use Illuminate\Support\Facades\Log;
use DB;

class LastRow extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createLastRowId($id)
    {
        return SELF::updateOrCreate([
          'last_id' => $id
        ]);
    }
    public function findLastRowId()
    {
        $last_id = SELF::latest('id')->pluck('last_id');
        foreach($last_id as $id)
        {
            return $id;   /* return int  */
        }
    }
    public function GoNextRow()
    {
      $id = SELF::findLastRowId();
      Log::info('Go next row old:  '.$id);
      $newId = DB::table('last_rows')->where('last_id', $id)
              ->increment('last_id');

      // $newId = SELF::find($id)->increment('last_id');

      Log::info('Go next row :  '.$newId);
      // dd($newId);
      return $newId;
    }
    public function GoNextRow()
}
