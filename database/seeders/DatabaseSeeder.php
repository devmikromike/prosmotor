<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\Company::factory(10)->create();
                 $this->call(UserSeeder::class);
                  $this->call(LisenseTypeSeeder::class);
                  $this->call(RoleSeeder::class);
    }
}
