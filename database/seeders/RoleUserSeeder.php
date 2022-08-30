<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      RoleUser::create([
          'user_id' => 99,
          'role_id' => 2,
          'company_id' => 99,          
      ]);
    }
}
