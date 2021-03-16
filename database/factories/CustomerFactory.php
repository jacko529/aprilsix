<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class CustomerFactory extends Factory
{

    protected $model = Customer::class;

    public function definition()
    {
        return [
            'ref' => $this->faker->asciify('********************'),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address, // password
        ];
    }
}
