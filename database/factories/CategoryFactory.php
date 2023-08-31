<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(mt_rand(1, 3), true),
        ];
    }
}
