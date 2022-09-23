<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
      $this->call(LisenseTypeSeeder::class);
      $this->call(RoleSeeder::class);
      //   \App\Models\User::factory(10)->create();
          \App\Models\Company::factory(20)->create();
            $this->call(UserSeeder::class);
              $this->call(LisenseSeeder::class);
               $this->call(CompanySeeder::class);
                $this->call(ProfileSeeder::class);
                 $this->call(RoleUserSeeder::class);

    }
}
