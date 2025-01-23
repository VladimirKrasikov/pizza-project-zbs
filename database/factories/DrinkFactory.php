<?php

namespace Database\Factories;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrinkFactory extends Factory
{
    protected $model = Drink::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 20),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
