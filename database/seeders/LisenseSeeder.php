<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lisense;

class LisenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Lisense::create([
          'type_id' => 2,
          'key' => 'ABC234567',
          'user_id' => 99,
          'status' => 'active',
      ]);
    }
}
