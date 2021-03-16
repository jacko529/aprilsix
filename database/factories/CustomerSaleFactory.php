<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CustomerSale;
use App\Models\Customer;
use App\Models\Product;

class CustomerSaleFactory extends Factory
{

    protected $model = CustomerSale::class;

    public function definition()
    {
        return [
            'order_number' => $this->faker->numberBetween(1, 1000),
            'customer_ref' => Customer::factory(),
            'part_number' => Product::factory(),
            'date' => $this->faker->dateTimeBetween('-30 days', 'now')
                                  ->format('d/m/Y')
        ];
    }

    public function products()
    {

        return $this->belongsTo(Product::class);

    }

    public function customers()
    {

        return $this->belongsTo(Customer::class);

    }
}
