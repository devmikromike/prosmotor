<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class ProspectRegister extends Model
{
    use HasFactory;
    protected $table = 'prospect_register';

    public function propects()
    {
      return $this->belongsToMany(Prospect::class, 'prospect_register',
                                        'prospect_id','register_id');
    }
}
