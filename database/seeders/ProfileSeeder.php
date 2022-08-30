<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Profile::create([
          'company_id' => 99,
          'user_id' => 99,
          'saved_key_id' => 3,
          'settings_id' => 3,
          'session_id' => '',
      ]);
    }
}
