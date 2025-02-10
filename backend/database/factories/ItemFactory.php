<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Item::class;
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(8, 9),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'base_stock' => $this->faker->numberBetween(1, 100),
            'min_stock' => $this->faker->numberBetween(1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
