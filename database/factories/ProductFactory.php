<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(mt_rand(1, 3), true),
            'price' => mt_rand(100, 5000),
        ];
    }
}
