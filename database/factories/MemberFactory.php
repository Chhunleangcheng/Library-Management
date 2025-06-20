<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'membership_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'membership_status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }
}
