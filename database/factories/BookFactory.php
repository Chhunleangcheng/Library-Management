<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'genre' => $this->faker->randomElement(['Fiction', 'Non-Fiction', 'Science Fiction', 'Fantasy', 'Mystery', 'Romance', 'Biography']),
            'isbn' => $this->faker->unique()->isbn13(),
            'description' => $this->faker->paragraph(),
            'published_year' => $this->faker->year(),
            'total_copies' => $this->faker->numberBetween(1, 10),
            'available_copies' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['total_copies']);
            },
        ];
    }
}
