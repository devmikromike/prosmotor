<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsDetails extends Model
{
    use HasFactory;

  protected $guarded = [];

    public function saveUri($uri, $id)
    {
       $data = ProsDetails::updateOrCreate([
         'pros_id' => $id,
         'url' => $uri
       ]);

       return $data;
    }
}
