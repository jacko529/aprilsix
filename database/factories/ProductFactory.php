<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition()
    {
        return [
            'part_number' => $this->faker->asciify('********************'),
            'description' => implode(',', $this->faker->words(20)),
            'category' => $this->faker->word(),
            'sub_category' => $this->faker->word(),
        ];
    }


}
