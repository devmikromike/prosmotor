<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create([
          'name' => 'user',
          'title' => 'User',
          'level' => 1,
          'guard' => 'web',
          'options' => '',
      ]);
      Role::create([
          'name' => 'admin',
          'title' => 'Admin',
          'level' => 3,
          'guard' => 'web',
          'options' => '',
      ]);
    }
}
