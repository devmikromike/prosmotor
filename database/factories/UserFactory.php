<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
          'name' => $this->faker->name,
          'email' => $this->faker->unique()->safeEmail,
          'email_verified_at' => now(),
          'password' => 'yIXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'remember_token' => Str::random(10),
          'username' => $this->faker->name,
          'enabled' => $this->faker->numberBetween(0, 1),
        ];
    }
}
