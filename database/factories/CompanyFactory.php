<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
  public function definition()
    {
        return [
           'name' => $this->faker->name,
           'vatId' => $this->faker->unique(true)->regexify('[1-9]{7}[-][1-9]{1}'),
           'prospect_id' => $this->faker->unique(true)->numberBetween(1, 50),
           'auxiliaryCompany' => $this->faker->numberBetween(0, 1),
        //    $faker->regexify('[1-9]{7}[-][1-9]{1}');
        ];
    }
}
