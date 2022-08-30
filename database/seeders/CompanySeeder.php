<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Company::create([
          'id' => 99,
          'name' => 'MikroMike Oy',
          'vatId' => '2219399-0',
          'prospect_id' => 99,
          'auxiliaryCompany' => 0,
      ]);
    }
}
