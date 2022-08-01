<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name' => $this->faker->name,
           'vatId' => $this->faker->unique(true)->numberBetween(1, 50),
            'prospect_id' => $this->faker->unique(true)->numberBetween(1, 50),
            'auxiliaryCompany' => $this->faker->numberBetween(0, 1),
        ];
    }
}
