<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;

class SearchEndpointTest extends TestCase
{

    use RefreshDatabase;

    public function test_search_1_product_successfully()
    {

        $product = Product::factory(1)
               ->create();

        $response = $this->getJson('/api/aprilsix/search?search='.$product->first()->part_number.'');

        $response->assertStatus(200);
        $response->assertJsonPath('data.products.0.part_number', $product->first()->part_number);
        $response->assertJsonCount(1, 'data.products');
        $response->assertJsonPath('data.customer', []);

    }

    public function test_search_1_customer_successfully()
    {
        $customer = Customer::factory(1)
                          ->create();


        $response = $this->getJson('/api/aprilsix/search?search='.$customer->first()->ref.'');

        $response->assertStatus(200);
        $response->assertJsonPath('data.customer.0.ref', $customer->first()->ref);
        $response->assertJsonCount(1, 'data.customer');
        $response->assertJsonPath('data.products', []);

    }

    public function test_search_0_results()
    {

        $response = $this->getJson('/api/aprilsix/search?search=""');

        $response->assertStatus(200);
        $response->assertJsonPath('data.products', []);
        $response->assertJsonPath('data.customer', []);

    }

    public function test_search_error()
    {

        $response = $this->getJson('/api/aprilsix/search');


        $response->assertStatus(422);
        $response->assertJsonPath('error', 'Search Query String Is Required');

    }

}
