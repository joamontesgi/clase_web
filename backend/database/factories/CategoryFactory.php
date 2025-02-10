<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    // Asocia la fábrica con el modelo Category
    protected $model = Category::class;

    /**
     * Define el estado por defecto para el modelo Category.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
