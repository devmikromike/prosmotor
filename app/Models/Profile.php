<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;
    protected $table='profiles';
    protected $fillable = [
      'company_id','user_id',
      'settings_id','saved_key_id',
      'session_id'
    ];

    public function user()
    {
      return $this->belongTo(User::class);
    }
}
