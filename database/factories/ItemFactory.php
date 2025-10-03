<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class ItemFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 2),
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'description' => $this->faker->text(),
            'img' => fake()->randomElement(['https://plus.unsplash.com/premium_photo-1668146927669-f2edf6e86f6f', 'https://images.unsplash.com/photo-1526318896980-cf78c088247c'
            , 'https://images.unsplash.com/photo-1658043186384-7add63d278fd','https://images.unsplash.com/photo-1641790048634-3133a49929e1']),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
