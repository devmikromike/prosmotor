<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsCity extends Model
{
    use HasFactory;

    protected $table = 'locations';

    public function scopeCity($query, $city)
    {
      return $query->where('city', $city);
    }
}
