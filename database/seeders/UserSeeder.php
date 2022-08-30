<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run()

   {
       User::create([
           'id' => 99,
           'name' => 'Mikromike',
           'email' => env('ADMIN_EMAIL'),
           'password' => bcrypt(env('ADMIN_PASSWORD')),
           'username' => 'MikroMike',
           'enabled' => 1
       ]);
   }
}
