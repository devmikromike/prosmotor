<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AuthUser extends Model
{
    use HasFactory;
    protected $fillable=['last_login_time', 'last_login_ip', 'user_id'];
}
