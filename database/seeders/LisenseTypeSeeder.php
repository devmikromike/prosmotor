<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\LisenseType;


class LisenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      LisenseType::create([
          'name' => 'Trial',
          'status' => 'Limited time',
          'active' => 1,
          'desc' => 'Limited time 30 days. ',
          'days' => '30',
      ]);
      LisenseType::create([
          'name' => 'Yearly',
          'status' => 'Time',
          'active' => 1,
          'desc' => 'Time 365 days. ',
          'days' => '365',
      ]);
    }
}
