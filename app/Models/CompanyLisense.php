<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyLisense extends Pivot
{
    use HasFactory;
    protected $fillable = [
      'company_id','lisense_id'
    ];
    protected $table = 'company_lisenses';
}
